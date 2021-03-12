<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleType;

class VehicleController extends Controller
{
    public function index(){
        return view('vehicles.index');
    }

    public function show($id){
        return Vehicle::find($id);
    }

    public function create(){
        $vehicles_type = VehicleType::all();
        return view('vehicles.create', [
            'vehicles_type' => $vehicles_type
        ]);
    }
}
