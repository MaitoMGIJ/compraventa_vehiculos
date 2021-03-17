<?php

namespace App\Http\Livewire;

use App\Models\VehicleBrand;
use App\Models\VehicleReference;
use App\Models\VehicleType;
use Livewire\Component;

class VehicleCreateForm extends Component
{
    public $vehicle_types;
    public $brands;
    public $references;

    public $selectedVehicleType = null;
    public $selectedVehicleBrand = null;

    public function mount(){
        $this->brands = collect();
        $this->references = collect();
    }

    public function render(){
        return view('livewire.vehicle-create-form', [
            'vehicle_types' => $this->vehicle_types
        ]);
    }

    public function updatedSelectedVehicleType($vehicleType){
        if(!is_null($vehicleType) && !empty($vehicleType)){
            $vehicle_type = VehicleType::where('id', '=', $vehicleType)->first();
            $this->brands = $vehicle_type->brands()->get();
            $this->references = collect();
            $this->selectedVehicleBrand = null;
        }else{
            $this->brands = collect();
            $this->references = collect();
            $this->selectedVehicleBrand = null;
            $this->selectedVehicleType = null;
        }
    }

    public function updatedSelectedVehicleBrand($vehicleBrand){
        if(!is_null($vehicleBrand) && !empty($vehicleBrand)){
            $vehicle_brand = VehicleBrand::where('id', '=', $vehicleBrand)->first();
            $this->references = $vehicle_brand->references()->get();
        }else{
            $this->references = collect();
            $this->selectedVehicleBrand = null;
        }
    }
}
