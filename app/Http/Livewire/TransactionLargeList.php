<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Str;

class TransactionLargeList extends Component
{
    public $searchTerm = '';

    public function mount($transactions){
        $this->transactions = $transactions;
    }

    public function render()
    {
        $this->searchTerm = Str::upper($this->searchTerm);
        if(empty($this->searchTerm) || is_null($this->searchTerm)){
            $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);
        }else{
            $transactions = Transaction::join('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
                ->where('vehicles.license', 'like', "%{$this->searchTerm}%")
                ->orderBy('transactions.created_at', 'desc')
                ->paginate(10, ['transactions.*']);
        }
        return view('livewire.transaction-large-list', [
            'transactions' => $transactions
        ]);
    }
}
