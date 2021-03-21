<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class VehiclesTable extends Component
{
    use WithPagination;

    public $initialDate;
    public $endDate;
    public $is_active;

    public function render()
    {
        $vehicles = [];
        if($this->is_active == ''){
            $vehicles = Vehicle::paginate(10);
        }else if($this->is_active == 'true'){
            $vehicles = Vehicle::where('vehicles.is_active', true)
                ->entryBetween($this->initialDate, $this->endDate)
                ->paginate(8);
        }else if($this->is_active == 'false'){
            $vehicles = Vehicle::where('vehicles.is_active', false)
                ->endBetween($this->initialDate, $this->endDate)
                ->paginate(8);
        }

        return view('livewire.vehicles-table', [
            'vehicles' => $vehicles
        ]);
    }
}
