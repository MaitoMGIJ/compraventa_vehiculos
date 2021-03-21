<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;

    public $initialDate;
    public $endDate;

    public function render()
    {
        $transactions = Transaction::between($this->initialDate, $this->endDate)->paginate(10);
        return view('livewire.transactions-table', [
            'transactions' => $transactions
        ]);
    }

    public function exportCSV(){
        $transactions = Transaction::between($this->initialDate, $this->endDate)
            ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->leftJoin('vehicle_brands', 'vehicle_brands.id', '=', 'vehicles.brand')
            ->leftJoin('vehicle_references', 'vehicle_references.id', '=', 'vehicles.reference')
            ->leftJoin('agents', 'agents.id', '=', 'transactions.agent_id')
            ->orderBy('transactions.date')
            ->orderBy('transactions.created_at');
        return response()->streamDownload(function() use($transactions){
            echo $transactions->toCsv(config('exports.transactions.csv'));
        }, trans_choice('tags.transaction', 2).time().'.csv');
    }
}
