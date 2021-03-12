<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    use HasFactory;

    public function types(){
        return $this->hasMany(VehicleType::class);
    }

    public function references(){
        return $this->hasMany(VehicleReference::class, 'brand');
    }
}
