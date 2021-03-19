<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(){
        return view('reports.transactions');
    }

    public function transactions(Request $request){
        $transactions = Transaction::between($request->date_start, $request->date_end)->get();
        $entries = $transactions->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray());
        $ends = $transactions->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray());
        $expenses = $transactions->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray());
        $incomes = $transactions->whereIn('transaction_type', TransactionType::income()->get()->pluck('id')->values()->toArray());

        return view('reports.transactions.list', [
            'transactions' => $transactions
        ]);
    }
}
