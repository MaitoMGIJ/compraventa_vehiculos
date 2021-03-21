<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $initialDate;
    public $endDate;


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
        $transactions = Transaction::between($this->initialDate, $this->endDate)
            ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->leftJoin('vehicle_brands', 'vehicle_brands.id', '=', 'vehicles.brand')
            ->leftJoin('vehicle_references', 'vehicle_references.id', '=', 'vehicles.reference')
            ->leftJoin('agents', 'agents.id', '=', 'transactions.agent_id')
            ->orderBy('transactions.date')
            ->orderBy('transactions.created_at')
            ->get(array_values($this->columns));

        return $transactions;
    }

    function headings(): array
    {
        return array_map(function($title){
            return __('tags.'.$title);
        }, array_keys($this->columns));
    }
    /*public function headings()
    {

        return array();
    }*/
}
