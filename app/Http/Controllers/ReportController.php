<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Livewire\Livewire;

class ReportController extends Controller
{

    public function index(){
        return view('reports.index');
    }

    public function transactions(Request $request){
        /*$transactions = Transaction::between($request->date_start, $request->date_end)->paginate(10);
        $entries = $transactions->whereIn('transaction_type', TransactionType::entry()->get()->pluck('id')->values()->toArray());
        $ends = $transactions->whereIn('transaction_type', TransactionType::end()->get()->pluck('id')->values()->toArray());
        $expenses = $transactions->whereIn('transaction_type', TransactionType::expense()->get()->pluck('id')->values()->toArray());
        $incomes = $transactions->whereIn('transaction_type', TransactionType::income()->get()->pluck('id')->values()->toArray());

        return view('reports.transactions.list', [
            'transactions' => $transactions
        ]);*/
        return view('reports.transactions.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end
        ]);
    }

    public function balance(Request $request){
        return view('reports.transactions.balance', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end
        ]);
    }

    public function activeVehicles(Request $request){
        return view('reports.vehicles.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end,
            'license' => $request->license,
            'is_active' => 'true',
            'top' => false,
            'inventory' => false
        ]);
    }

    public function inactiveVehicles(Request $request){
        return view('reports.vehicles.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end,
            'license' => $request->license,
            'is_active' => 'false',
            'top' => false,
            'inventory' => false
        ]);
    }

    public function vehicles(Request $request){
        return view('reports.vehicles.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end,
            'license' => $request->license,
            'is_active' => '',
            'top' => false,
            'inventory' => false
        ]);
    }

    public function commissions(Request $request){
        return view('reports.commission.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end,
            'agentId' => $request->agentId
        ]);
    }

    public function topUnsold(){
        return view('reports.vehicles.list', [
            'initialDate' => null,
            'endDate' => null,
            'license' => null,
            'is_active' => '',
            'top' => true,
            'inventory' => false
        ]);
    }

    public function inventory(Request $request){
        return view('reports.vehicles.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end,
            'license' => $request->license,
            'is_active' => '',
            'top' => false,
            'inventory' => true
        ]);
    }

    public function expenses(Request $request){
        return view('reports.expense.list', [
            'initialDate' => $request->date_start,
            'endDate' => $request->date_end
        ]);
    }
}
