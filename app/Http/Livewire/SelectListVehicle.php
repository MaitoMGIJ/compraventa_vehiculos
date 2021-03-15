<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class SelectListVehicle extends Component
{
    public function render()
    {
        $vehicles = Vehicle::where('is_active', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.select-list-vehicle', [
            'vehicles' => $vehicles
        ]);
    }
}
