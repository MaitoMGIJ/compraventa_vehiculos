<?php

namespace App\Http\Livewire;

use App\Exports\BalanceExport;
use App\Models\Transaction;
use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BalanceTable extends Component
{
    use WithPagination;

    public $initialDate;
    public $endDate;
    public $transactions;

    public function render()
    {
        $this->transactions = collect();

        $this->initialDate = is_null($this->initialDate) ? Transaction::min('date') : $this->initialDate;

        $dates = Transaction::between($this->initialDate, $this->endDate)->pluck('date')->values()->unique();

        foreach($dates as $date){
            $transaction = collect();
            $transaction->date = $date;
            $transaction->entries = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->commissions = Transaction::between($date, $date)
            ->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())->sum('commission') +
            Transaction::between($date, $date)
            ->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())->sum('commission');

            $transaction->ends = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->expenses = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->incomes = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::income()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->withdrawals = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::withdrawal()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->balance =
                ($transaction->incomes + $transaction->ends) -
                ($transaction->entries + $transaction->commissions + $transaction->expenses + $transaction->withdrawals)
                ;

            $this->transactions->push($transaction);
        }

        return view('livewire.balance-table', [
            'transactions' => $this->transactions
        ]);
    }

    public function exportXLS(){
        return Excel::download(
            new BalanceExport($this->initialDate, $this->endDate, config('exports.balance.xls')),
                __('tags.balance').time().'.xlsx'
            );
    }

    public function calculate(){

        $transactions = collect();

        $dates = Transaction::between($this->initialDate, $this->endDate)->pluck('date')->values()->unique();

        foreach($dates as $date){
            $transaction = collect();
            $transaction->date = $date;
            $transaction->entries = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->commissions = Transaction::between($date, $date)
            ->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray())->sum('commission') +
            Transaction::between($date, $date)
            ->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())->sum('commission');

            $transaction->ends = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->expenses = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->incomes = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::income()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->withdrawals = Transaction::between($date, $date)
                ->whereIn('transaction_type', TransactionType::withdrawal()->get()->pluck('id')->values()->toArray())->sum('value');

            $transaction->balance =
                ($transaction->incomes + $transaction->ends) -
                ($transaction->entries + $transaction->commissions + $transaction->expenses + $transaction->withdrawals)
                ;

            $transactions->push($transaction);
        }

        return $transactions;
    }
}
