<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TransactionCreateForm extends Component
{
    public $transaction_types;
    public $agents;
    public $expense;
    public $income;

    public function render()
    {
        return view('livewire.transaction-create-form', [
            'transaction_types' => $this->transaction_types,
            'agents' => $this->agents,
            'expense' => $this->expense,
            'income' => $this->income
        ]);
    }
}
