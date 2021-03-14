<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'transaction_type', 'value', 'date', 'agent_id', 'support', 'commission', 'user_id', 'is_active'];

    public function type(){
        return $this->belongsTo(TransactionType::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
