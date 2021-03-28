<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExpensesExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        $expenses = Transaction::between($this->initialDate, $this->endDate)
            ->join('transaction_types', 'transactions.transaction_type', '=', 'transaction_types.id')
            ->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray())
            ->select('transaction_types.description as expense',
                DB::raw('SUM(value) as value')
                )
            ->groupBy('transaction_types.description')
            ->get()
            ;

        return $expenses;
    }

    public function headings(): array
    {
        return array_map(function($title){
            return trans_choice('tags.'.$title, 1);
        }, array_keys($this->columns));
    }
}
