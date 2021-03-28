<?php

namespace App\Http\Livewire;

use App\Exports\VehicleExport;
use App\Exports\VehicleEndExport;
use App\Exports\VehicleEntryExport;
use App\Exports\VehicleInventoryExport;
use App\Exports\VehiclePawnExport;
use App\Models\Transaction;
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
    public $inventory;
    public $pawn;
    public $top;

    public function render()
    {
        $vehicles = [];
        $license = is_null($this->license) ? '' : $this->license;
        $initialDate = is_null($this->initialDate) ? Transaction::min('date') : $this->initialDate;
        $endDate = is_null($this->endDate) ? Transaction::max('date') : $this->endDate;
        if($this->pawn){
            $v = Vehicle::where('vehicles.license', 'like', "%$license%")
                ->pawnBetween($initialDate, $endDate)
                ->get();
            $vehicles = $v->filter(function($vehicle) use($endDate){
                $v = Vehicle::find($vehicle->id);
                if(is_null($v->getEndTransaction())){
                    return $v;
                }else{
                    if($v->getEndTransaction()->date > $endDate){
                        return $v;
                    }
                }
            });
        }else if($this->inventory){
            $v = Vehicle::where('vehicles.license', 'like', "%$license%")
                ->entryBetween($initialDate, $endDate)->get();
            $vehicles = $v->filter(function($vehicle) use($endDate){
                $v = Vehicle::find($vehicle->id);
                if(is_null($v->getEndTransaction())){
                    return $v;
                }else{
                    if($v->getEndTransaction()->date > $endDate){
                        return $v;
                    }
                }
            });
        }else if($this->top){
            $vehicles = Vehicle::where('vehicles.is_active', true)->
                orderBy('vehicles.created_at', 'asc')->take(config('top.top'))->get();
        }else if($this->is_active == ''){
            $vehicles = Vehicle::where('vehicles.license', 'like', "%$license%")->paginate(10);
        }else if($this->is_active == 'true'){
            $vehicles = Vehicle::where('vehicles.license', 'like', "%$license%")
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
            'license' => $this->license,
            'inventory' => $this->inventory,
            'pawn' => $this->pawn
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
        if($this->pawn){
            return Excel::download(
                new VehiclePawnExport($this->initialDate, $this->endDate, $this->license, config('exports.vehicles.pawn.xls')),
                    trans_choice('tags.pawn', 2).time().'.xlsx'
                );
        }else if($this->inventory){
            return Excel::download(
                new VehicleInventoryExport($this->initialDate, $this->endDate, $this->license, config('exports.vehicles.inventory.xls')),
                    trans_choice('tags.inventory', 2).time().'.xlsx'
                );
        }else if($this->is_active == ''){
            return Excel::download(
                new VehicleExport($this->initialDate, $this->endDate, $this->license, config('exports.vehicles.all.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }else if($this->is_active == 'true'){
            return Excel::download(
                new VehicleEntryExport($this->initialDate, $this->endDate, $this->license, config('exports.vehicles.entry.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }else if($this->is_active == 'false'){
            return Excel::download(
                new VehicleEndExport($this->initialDate, $this->endDate, $this->license, config('exports.vehicles.end.xls')),
                    trans_choice('tags.vehicle', 2).time().'.xlsx'
                );
        }
    }
}
