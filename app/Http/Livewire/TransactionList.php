<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TransactionList extends Component
{
    public $transactions;

    public function mount($transactions){
        $this->transactions = $transactions;
    }

    public function render()
    {
        return view('livewire.transaction-list', [
            'transactions' => $this->transactions
        ]);
    }
}
