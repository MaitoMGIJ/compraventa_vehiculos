<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\TransactionType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BalanceExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $transactions;
    public $columns;

    public function __construct($initialDate, $endDate, $columns){
        $this->initialDate = $initialDate;
        $this->endDate = $endDate;
        $this->columns = $columns;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
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

    public function headings(): array
    {
        //dd(array_keys($this->columns));
        return array_map(function($title){
            return trans_choice('tags.'.$title, 2);
        }, array_keys($this->columns));
    }
}
