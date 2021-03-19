<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableTransactions extends Component
{
    public $transactions;

    public function mount($transactions){
        $this->transactions = $transactions;
    }

    public function render()
    {
        return view('livewire.table-transactions', [
            'transactions' => $this->transactions
        ]);
    }
}
