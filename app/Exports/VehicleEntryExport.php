<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VehicleEntryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $initialDate;
    public $endDate;
    public $columns;

    public function __construct($initialDate, $endDate, $columns){
        $this->initialDate = $initialDate;
        $this->endDate = $endDate;
        $this->columns = $columns;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vehicle::query()
        ->entriesReport($this->initialDate, $this->endDate)
        ->get(array_values($this->columns));
    }

    public function headings(): array
    {
        return array_map(function($title){
            return __('tags.'.$title);
        }, array_keys($this->columns));
    }
}
