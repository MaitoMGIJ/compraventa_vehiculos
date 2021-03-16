<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleList extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $vehicles = [];
        $vehicles = Vehicle::where('license', 'like', "%{$this->searchTerm}%")
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('livewire.vehicle-list', [
            'vehicles' => $vehicles
        ]);
    }
}
