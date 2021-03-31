<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class TransactionLargeCard extends Component
{
    public $transaction;

    public function mount(Transaction $transaction){
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.transaction-large-card', [
            'transaction' => $this->transaction
        ]);
    }
}
