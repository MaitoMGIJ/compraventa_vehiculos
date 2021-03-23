<?php

namespace App\Http\Livewire;

use App\Exports\CommissionsExport;
use App\Models\Agent;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
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
        $transactions = null;
        $agents = null;
        $initialDate = is_null($this->initialDate) ? '1900-01-01' : $this->initialDate;
        $endDate = is_null($this->endDate) ? '3000-01-01' : $this->endDate;
        if($this->agentId){
            $transactions = Transaction::where('agent_id', $this->agentId)
                ->between($initialDate, $endDate)
                ->get();
        }else{
            $agents = Agent::join('transactions', 'transactions.agent_id', '=', 'agents.id')
                ->whereBetween('transactions.date', [$initialDate, $endDate])
                ->groupBy('agents.id')
                ->select('agents.name', DB::raw('SUM(transactions.commission) as commissions'))
                ->get();
            $agents->map(function($agent){
                $agent->initialDate = is_null($this->initialDate) ? Transaction::min('date') : $this->initialDate;
                $agent->endDate = is_null($this->endDate) ? Transaction::max('date') : $this->endDate;
                return $agent;
            });
        }
        return view('livewire.commissions-table', [
            'transactions' => $transactions,
            'agents' => $agents
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
