<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Vehicle;

class VehicleCard extends Component
{

    public $vehicle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.vehicle-card');
    }
}
