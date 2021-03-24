<?php

namespace App\Http\Livewire;

use App\Exports\VehicleExport;
use App\Exports\VehicleEndExport;
use App\Exports\VehicleEntryExport;
use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class VehiclesTable extends Component
{
    use WithPagination;

    public $initialDate;
    public $endDate;
    public $is_active;
    public $license;

    public function render()
    {
        $vehicles = [];
        $license = is_null($this->license) ? '' : $this->license;
        $initialDate = is_null($this->initialDate) ? '1900-01-01' : $this->initialDate;
        $endDate = is_null($this->endDate) ? '3000-01-01' : $this->endDate;
        if($this->is_active == ''){
            $vehicles = Vehicle::where('vehicles.license', 'like', "%$license%")->paginate(10);
        }else if($this->is_active == 'true'){
            $vehicles = Vehicle::where('vehicles.is_active', true)
                ->where('vehicles.license', 'like', "%$license%")
                ->entryBetween($initialDate, $endDate)
                ->paginate(8);
        }else if($this->is_active == 'false'){
            $vehicles = Vehicle::where('vehicles.is_active', false)
                ->where('vehicles.license', 'like', "%$license%")
                ->endBetween($initialDate, $endDate)
                ->get();
        }

        return view('livewire.vehicles-table', [
            'vehicles' => $vehicles,
            'license' => $this->license
        ]);
    }

    public function exportCSV(){
        $vehicles = collect();
        if($this->is_active == ''){
            return response()->streamDownload(function(){
                echo Vehicle::query()
                ->allReport($this->initialDate, $this->endDate)
                ->toCsv(config('exports.vehicles.all.csv'));
            }, trans_choice('tags.vehicle', 2).time().'.csv');
        }else if($this->is_active == 'true'){
            return response()->streamDownload(function(){
                echo Vehicle::query()
                ->entriesReport($this->initialDate, $this->endDate)
                ->toCsv(config('exports.vehicles.entry.csv'));
            }, trans_choice('tags.vehicle', 2).time().'.csv');
        }else if($this->is_active == 'false'){
            return response()->streamDownload(function(){
                echo Vehicle::query()
                ->endsReport($this->initialDate, $this->endDate)
                ->toCsv(config('exports.vehicles.end.csv'));
            }, trans_choice('tags.vehicle', 2).time().'.csv');
        }

    }

    public function exportXLS(){
        if($this->is_active == ''){
            return Excel::download(
                new VehicleExport($this->initialDate, $this->endDate, config('exports.vehicles.all.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }else if($this->is_active == 'true'){
            return Excel::download(
                new VehicleEntryExport($this->initialDate, $this->endDate, config('exports.vehicles.entry.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }else if($this->is_active == 'false'){
            return Excel::download(
                new VehicleEndExport($this->initialDate, $this->endDate, config('exports.vehicles.end.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }
    }
}
