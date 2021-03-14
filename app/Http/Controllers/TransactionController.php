<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){

    }

    public function create(){
        $transaction_types = TransactionType::where('entry', true)->where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types
        ]);
    }
}
