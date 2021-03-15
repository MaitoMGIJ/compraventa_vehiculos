<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleInfo extends Component
{
    public $vehicle_id;

    public function mount($vehicle_id = null){
        $this->vehicle_id = $vehicle_id;
    }

    public function render()
    {
        $vehicle = Vehicle::where('id', $this->vehicle_id)->get()->first();
        return view('livewire.vehicle-info', [
            'vehicle' => $vehicle
        ]);
    }
}
