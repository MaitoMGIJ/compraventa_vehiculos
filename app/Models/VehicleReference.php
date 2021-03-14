<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleReference extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'description', 'is_active'];

    public function brand(){
        return $this->belongsTo(VehicleBrand::class, 'brand');
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
