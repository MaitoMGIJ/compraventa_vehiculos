<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

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
        return url("storage/{$this->photo}");
    }

    public function getTransactions(){
        return $this->transactions()->get();
    }

    public function hasTransactions(){
        return count($this->getTransactions()) > 0 ? true : false;
    }
}
