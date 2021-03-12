<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrand;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function brandType(Request $request){
        $vehicle_type = VehicleType::where('id', '=',$request->id)->first();
        return $vehicle_type->brands()->get();
    }

    public function referenceBrand(Request $request){
        $vehicle_brand = VehicleBrand::where('id', '=', $request->id)->first();
        return $vehicle_brand->references()->get();
    }


}
