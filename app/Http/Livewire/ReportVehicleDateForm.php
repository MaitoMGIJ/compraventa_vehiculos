<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReportVehicleDateForm extends Component
{
    public $route;
    public $title;

    public function render()
    {
        return view('livewire.report-vehicle-date-form', [
            'route' => $this->route,
            'title' => $this->title
        ]);
    }
}
