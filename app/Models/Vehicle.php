<?php

namespace App\Models;

use App\Traits\HasDefaultImage;
use App\Traits\HasCheckExistsUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, HasDefaultImage, HasCheckExistsUrl;

    protected $fillable = ['license', 'type', 'brand', 'reference', 'model', 'color', 'photo', 'comment', 'is_active'];

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

}
