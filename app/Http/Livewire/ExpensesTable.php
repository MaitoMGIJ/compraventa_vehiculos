<?php

namespace App\Http\Livewire;

use App\Exports\ExpensesExport;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExpensesTable extends Component
{
    public $initialDate;
    public $endDate;

    public function render()
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

        return view('livewire.expenses-table', [
            'expenses' => $expenses
        ]);
    }

    public function exportXLS(){
        return Excel::download(
            new ExpensesExport($this->initialDate, $this->endDate, config('exports.expenses.xls')),
                trans_choice('tags.expense', 2).time().'.xlsx'
            );
    }
}
