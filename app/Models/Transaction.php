<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'transaction_type', 'value', 'date', 'agent_id', 'support', 'commission', 'user_id', 'is_active'];

    public function type(){
        return $this->belongsTo(TransactionType::class, 'transaction_type');
    }

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTypeAttribute(){
        return $this->type()->get()->first()->description;
    }

    public function getTypeIdAttribute(){
        return $this->type()->get()->first()->id;
    }

    public function getAgentAttribute(){
        return $this->agent()->get()->first()->name;
    }

    public function getUserAttribute(){
        return $this->user()->get()->first()->name;
    }

    public function hasAgent(){
        return is_null($this->agent_id) ? false : true;
    }

    public function hasSupport(){
        return is_null($this->support) ? false : true;
    }

    public function getUrlSupportAttribute(){
        return url("storage/".$this->support);
    }

    public function scopeBetween($query, $start, $end){
        return $query->whereBetween('date', [$start, $end]);
    }

}
