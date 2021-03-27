<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'entry', 'end', 'expense', 'income', 'status'];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function scopeEntry($query){
        return $query->where('entry', true);
    }

    public function scopeEnd($query){
        return $query->where('end', true);
    }

    public function scopeExpense($query){
        return $query->where('expense', true);
    }

    public function scopeIncome($query){
        return $query->where('income', true);
    }

    public function scopeWithdrawal($query){
        return $query->where('withdrawal', true);
    }
}
