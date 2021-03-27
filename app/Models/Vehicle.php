<?php

namespace App\Models;

use App\Traits\HasDefaultImage;
use App\Traits\HasCheckExistsUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle extends Model
{
    use HasFactory, HasDefaultImage, HasCheckExistsUrl;

    protected $fillable = ['license', 'type', 'brand', 'reference', 'model', 'color', 'insurance_expiration', 'technomechanical_expiration', 'photo', 'comment', 'is_active'];

    public function reference(){
        return $this->belongsTo(VehicleReference::class, 'reference');
    }

    public function brand(){
        return $this->belongsTo(VehicleBrand::class, 'brand');
    }

    public function type(){
        return $this->belongsTo(VehicleType::class, 'type');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function getNameAttribute(){
        $reference = $this->reference()->get()->first()->description;
        $brand = $this->brand()->get()->first()->description;
        return "{$brand} {$reference} Modelo {$this->model}";
    }

    public function getUrlAttribute(){
        return url("storage/".$this->photo);
    }

    public function getImageAttribute(){
        return $this->getImage();
    }

    public function getTransactions(){
        return $this->transactions()->get();
    }

    public function hasTransactions(){
        return count($this->getTransactions()) > 0 ? true : false;
    }

    public function getEntryTransaction(){
        $entries = $this->transactions()->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())->get()->first();
        return $entries;
    }

    public function getEndTransaction(){
        $ends = $this->transactions()->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())->get()->first();
        return $ends;
    }

    public function getExpenseTransactions(){
        $expenses = $this->transactions()->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray())->get();
        return $expenses;
    }

    public function getSumExpenseAttribute(){
        return $this->getExpenseTransactions()->sum('value');
    }

    public function getEntryAttribute(){
        return is_null($this->getEntryTransaction()) ? 0 : $this->getEntryTransaction()->value;
    }

    public function getEndAttribute(){
        return is_null($this->getEndTransaction()) ? 0 : $this->getEndTransaction()->value;
    }

    public function getCommissionsAttribute(){
        $entry = is_null($this->getEntryTransaction()) ? 0 : $this->getEntryTransaction()->commission;
        $end = is_null($this->getEndTransaction()) ? 0 : $this->getEndTransaction()->commission;
        return $entry + $end;
    }

    public function getEarningsAttribute(){
        $entries = $this->entry;
        $end = $this->end;
        $expenses = $this->sumExpense;
        $commissions = $this->commissions;
        return $end - ($entries + $expenses + $commissions);

    }

    public function scopeEntryBetween($query, $start, $end){
        return $query->join('transactions', 'transactions.vehicle_id', '=', 'vehicles.id')
        ->whereIn('transactions.transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())
        ->whereBetween('transactions.date', [$start, $end])
        ->select('vehicles.id', 'vehicles.license', 'vehicles.type', 'vehicles.brand', 'vehicles.reference', 'vehicles.model', 'vehicles.color', 'vehicles.is_active',
            'transactions.id as tid', 'transactions.vehicle_id', 'transactions.transaction_type', 'transactions.value',
            'transactions.date', 'transactions.agent_id', 'transactions.commission', 'transactions.user_id', 'transactions.is_active as t_is_active'
        );
    }

    public function scopeEndBetween($query, $start, $end){
        return $query->join('transactions', 'transactions.vehicle_id', '=', 'vehicles.id')
        ->whereIn('transactions.transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())
        ->whereBetween('transactions.date', [$start, $end])
        ->select('vehicles.id', 'vehicles.license', 'vehicles.type', 'vehicles.brand', 'vehicles.reference', 'vehicles.model', 'vehicles.color', 'vehicles.is_active',
            'transactions.id as tid', 'transactions.vehicle_id', 'transactions.transaction_type', 'transactions.value',
            'transactions.date', 'transactions.agent_id', 'transactions.commission', 'transactions.user_id', 'transactions.is_active as t_is_active'
        );
    }

    public function scopeEndsReport($query, $initialDate, $endDate){
        return $query->join('transactions as t', 'vehicles.id', '=', 't.vehicle_id')
        ->join('transaction_types as tt', 't.transaction_type', '=', 'tt.id')
        ->join('vehicle_brands as vb', 'vb.id', '=', 'vehicles.brand')
        ->join('vehicle_references as vr', 'vr.id', '=', 'vehicles.reference')
        ->join('agents as a', 'a.id', '=', 't.agent_id')
        ->whereBetween('t.date', [$initialDate, $endDate])
        ->where('tt.end', true)
        ->where('vehicles.is_active', false)
        ->orderBy('entry_date')
        ->orderBy('end_date', 'desc')
        ->select(DB::raw("vehicles.id, vehicles.license, vb.description as brand, vr.description as reference, vehicles.model, (select t2.date from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_date, (select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_value, (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_commission, (select a2.name as agent from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_agent, (select sum(t2.value) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true) as expenses, t.date as end_date, t.value as end_value, t.commission as end_commission, a.name as end_agent, ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) - ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) + (select coalesce(sum(t2.value), 0) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true ))) as earnings"))
        ;
    }

    public function scopeEntriesReport($query, $initialDate, $endDate){
        return $query->join('transactions as t', 'vehicles.id', '=', 't.vehicle_id')
        ->join('transaction_types as tt', 't.transaction_type', '=', 'tt.id')
        ->join('vehicle_brands as vb', 'vb.id', '=', 'vehicles.brand')
        ->join('vehicle_references as vr', 'vr.id', '=', 'vehicles.reference')
        ->join('agents as a', 'a.id', '=', 't.agent_id')
        ->whereBetween('t.date', [$initialDate, $endDate])
        ->where('tt.entry', true)
        ->where('vehicles.is_active', true)
        ->orderBy('entry_date')
        ->orderBy('end_date', 'desc')
        ->select(DB::raw("vehicles.id, vehicles.license, vb.description as brand, vr.description as reference, vehicles.model, (select t2.date from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_date, (select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_value, (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_commission, (select a2.name as agent from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_agent, (select sum(t2.value) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true) as expenses, t.date as end_date, t.value as end_value, t.commission as end_commission, a.name as end_agent, ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) - ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) + (select coalesce(sum(t2.value), 0) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true ))) as earnings"))
        ;
    }

    public function scopeAllReport($query, $initialDate, $endDate){
        return $query->join('transactions as t', 'vehicles.id', '=', 't.vehicle_id')
        ->join('transaction_types as tt', 't.transaction_type', '=', 'tt.id')
        ->join('vehicle_brands as vb', 'vb.id', '=', 'vehicles.brand')
        ->join('vehicle_references as vr', 'vr.id', '=', 'vehicles.reference')
        ->join('agents as a', 'a.id', '=', 't.agent_id')
        ->whereBetween('t.date', [$initialDate, $endDate])
        ->where('tt.entry', true)
        ->orderBy('entry_date')
        ->orderBy('end_date', 'desc')
        ->select(DB::raw("vehicles.id, vehicles.license, vb.description as brand, vr.description as reference, vehicles.model, (select t2.date from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_date, (select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_value, (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_commission, (select a2.name as agent from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) as entry_agent, (select sum(t2.value) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true) as expenses, t.date as end_date, t.value as end_value, t.commission as end_commission, a.name as end_agent, ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) - ((select t2.value from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.entry is true) + (select t2.commission from transactions t2 inner join agents a2 on a2.id = t2.agent_id inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.end is true) + (select coalesce(sum(t2.value), 0) from transactions t2 inner join transaction_types tt2 on t2.transaction_type = tt2.id where t2.vehicle_id = vehicles.id and tt2.expense is true ))) as earnings"))
        ;
    }

}
