<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Str;

class SelectListVehicle extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $vehicles = [];
        $this->searchTerm = Str::upper($this->searchTerm);
        $vehicles = Vehicle::where('license', 'like', "%{$this->searchTerm}%")
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('livewire.select-list-vehicle', [
            'vehicles' => $vehicles
        ]);
    }
}
