<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Agent;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct(){
        $this->middleware('role:Admin|Registro');
    }

    public function end(Request $request){
        $transaction_types = TransactionType::where('end', true)->where('is_active', true)->get();
        $agents = Agent::where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types,
            'agents' => $agents,
            'vehicle' => $request->vehicle,
            'is_active' => 'false',
            'expense' => false,
            'income' => false
        ]);
    }

    public function create(Request $request){
        $transaction_types = TransactionType::where('expense', true)->where('is_active', true)->get();
        $agents = Agent::where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types,
            'agents' => $agents,
            'vehicle' => $request->vehicle,
            'is_active' => 'true',
            'expense' => true,
            'income' => false
        ]);
    }

    public function income(Request $request){
        $transaction_types = TransactionType::where('is_active', true)->where(function ($query){
            $query->where('income', true)->orWhere('withdrawal', true);
        })->get();
        $agents = Agent::where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types,
            'agents' => $agents,
            'vehicle' => $request->vehicle,
            'is_active' => 'true',
            'expense' => false,
            'income' => true
        ]);
    }

    public function store(TransactionRequest $request){
        $message = __('messages.transaction.created.fail');
        $error = true;
        $is_active = ($request->is_active == "true") ? true : false;
        DB::transaction(function () use($request, &$message, &$error, $is_active){
            $support = $request->file('support');
            if(!is_null($request->is_active)){
                Vehicle::where('id', $request->vehicle)->update([
                    'is_active' => $is_active
                ]);
            }
            Transaction::create([
                'vehicle_id' => $request->vehicle,
                'transaction_type' => $request->transaction_type,
                'value' => $request->value,
                'date' => $request->date,
                'support' => is_null($support) ? null : $support->store('transactions', 'public'),
                'agent_id' => $request->agent,
                'commission' => is_null($request->commission) ? 0 : $request->commission,
                'user_id' => Auth::user()->id
            ]);

            $message = trans('messages.transaction.created.done');
            $error = false;
        });

        if($request->vehicle){
            return redirect()->route('vehicle.show', Vehicle::find($request->vehicle))->with([
                'error' => $error,
                'message' => $message
            ]);
        }else{
            return redirect()->route('transaction.income')->with([
                'error' => $error,
                'message' => $message
            ]);
        }
    }
}
