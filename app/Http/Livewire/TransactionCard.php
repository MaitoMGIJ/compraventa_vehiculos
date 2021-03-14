<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class TransactionCard extends Component
{
    public $transaction;

    public function mount(Transaction $transaction){
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.transaction-card', [
            'transaction' => $this->transaction
        ]);
    }
}
