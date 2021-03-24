<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Str;

class VehicleList extends Component
{
    public $searchTerm = '';
    public $active = true;

    public function render()
    {
        $vehicles = [];
        $this->searchTerm = Str::upper($this->searchTerm);
        $vehicles = Vehicle::where('license', 'like', "%{$this->searchTerm}%")
            ->where('is_active', $this->active)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('livewire.vehicle-list', [
            'vehicles' => $vehicles
        ]);
    }
}
