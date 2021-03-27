<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VehicleInventoryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $initialDate;
    public $endDate;
    public $license;
    public $columns;

    public function __construct($initialDate, $endDate, $license, $columns){
        $this->initialDate = is_null($initialDate) ? Transaction::min('date') : $initialDate;
        $this->endDate = is_null($endDate) ? Transaction::max('date') : $endDate;
        $this->license = is_null($license) ? '' : $license;
        $this->columns = $columns;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $vehicles = Vehicle::where('vehicles.is_active', true)
            ->inventoryReport($this->initialDate, $this->endDate)
            ->where('vehicles.license', 'like', "%{$this->license}%")
                ->get(array_values($this->columns));
        $vehicles->map(function($vehicle){
            $v = Vehicle::find($vehicle->id);
            if(is_null($v->getEndTransaction())){
                $vehicle->earnings = $v->earnings;
                return $vehicle;
            }
        });
        return $vehicles;
    }

    public function headings(): array
    {
        return array_map(function($title){
            return __('tags.'.$title);
        }, array_keys($this->columns));
    }
}

