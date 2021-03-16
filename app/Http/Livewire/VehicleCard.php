<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleCard extends Component
{
    public $vehicle;

    public function mount(Vehicle $vehicle){
        $this->vehicle = $vehicle;
    }

    public function render()
    {
        return view('livewire.vehicle-card', [
            'vehicle' => $this->vehicle
        ]);
    }
}
