<?php

namespace App\Http\Livewire;

use App\Exports\CommissionsExport;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CommissionsTable extends Component
{
    use WithPagination;

    public $initialDate;
    public $endDate;
    public $agentId;

    public function render()
    {
        $transactions = Transaction::where('agent_id', $this->agentId)
            ->between($this->initialDate, $this->endDate)
            ->paginate(10);
        return view('livewire.commissions-table', [
            'transactions' => $transactions
        ]);
    }

    public function exportCSV(){
        $transactions = Transaction::where('agent_id', $this->agentId)
            ->between($this->initialDate, $this->endDate)
            ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->leftJoin('vehicle_brands', 'vehicle_brands.id', '=', 'vehicles.brand')
            ->leftJoin('vehicle_references', 'vehicle_references.id', '=', 'vehicles.reference')
            ->leftJoin('agents', 'agents.id', '=', 'transactions.agent_id')
            ->orderBy('transactions.date')
            ->orderBy('transactions.created_at');
        return response()->streamDownload(function() use($transactions){
            echo $transactions->toCsv(config('exports.commissions.csv'));
        }, __('commission').time().'.csv');
    }

    public function exportXLS(){
        return Excel::download(
            new CommissionsExport($this->initialDate, $this->endDate, $this->agentId, config('exports.commissions.xls')),
                __('tags.commission').time().'.xlsx'
            );
    }
}
