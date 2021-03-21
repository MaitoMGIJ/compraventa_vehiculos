<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class CommissionsTable extends Component
{
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
}
