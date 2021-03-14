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
        return $this->belongsTo(Vehicle::class);
    }

    public function getTypeAttribute(){
        return $this->type()->get()->first()->description;
    }

    public function getAgentAttribute(){
        return $this->agent()->get()->first()->name;
    }

    public function hasAgent(){
        return is_null($this->agent_id) ? false : true;
    }

}
