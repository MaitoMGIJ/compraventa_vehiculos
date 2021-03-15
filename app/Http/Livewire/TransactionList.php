<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TransactionList extends Component
{
    public $transactions;
    public $vehicle;

    public function mount($transactions, $vehicle = ''){
        $this->transactions = $transactions;
        $this->vehicle = $vehicle;
    }

    public function render()
    {
        return view('livewire.transaction-list', [
            'transactions' => $this->transactions,
            'vehicle' => $this->vehicle
        ]);
    }
}
