<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VehicleMiniCardWithImage extends Component
{

    public $vehicle;

    public function render()
    {
        return view('livewire.vehicle-mini-card-with-image', [
            'vehicle' => $this->vehicle
        ]);
    }
}
