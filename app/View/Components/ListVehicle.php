<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Vehicle;

class ListVehicle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->paginate(9);
        return view('components.list-vehicle', ['vehicles' => $vehicles]);
    }
}
