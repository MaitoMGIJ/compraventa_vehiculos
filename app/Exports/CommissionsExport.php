<?php

namespace App\Exports;

use App\Models\Agent;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CommissionsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $initialDate;
    public $endDate;
    public $agentId;
    public $columns;

    public function __construct($initialDate, $endDate, $agentId, $columns){
        $this->initialDate = is_null($initialDate) ? Transaction::min('date') : $initialDate;
        $this->endDate = is_null($endDate) ? Transaction::max('date') : $endDate;
        $this->columns = $columns;
        $this->agentId = $agentId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->agentId){
            $transactions = Transaction::where('agent_id', $this->agentId)
                ->between($this->initialDate, $this->endDate)
                ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type')
                ->leftJoin('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
                ->leftJoin('vehicle_brands', 'vehicle_brands.id', '=', 'vehicles.brand')
                ->leftJoin('vehicle_references', 'vehicle_references.id', '=', 'vehicles.reference')
                ->leftJoin('agents', 'agents.id', '=', 'transactions.agent_id')
                ->orderBy('transactions.date')
                ->orderBy('transactions.created_at')
                ->get(array_values($this->columns));

            return $transactions;
        }else{
            $agents = Agent::join('transactions', 'transactions.agent_id', '=', 'agents.id')
                ->whereBetween('transactions.date', [$this->initialDate, $this->endDate])
                ->groupBy('agents.id')
                ->select('agents.id', 'agents.name', DB::raw('SUM(transactions.commission) as commissions'))
                ->get(array_values($this->columns));

            return $agents;
        }
    }

    public function headings(): array
    {
        return array_map(function($title){
            return __('tags.'.$title);
        }, array_keys($this->columns));
    }

}
