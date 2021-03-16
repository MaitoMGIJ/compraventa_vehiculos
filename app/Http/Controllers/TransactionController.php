<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Agent;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function end(Request $request){
        $transaction_types = TransactionType::where('end', true)->where('is_active', true)->get();
        $agents = Agent::where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types,
            'agents' => $agents,
            'vehicle' => $request->vehicle,
            'is_active' => 'false'
        ]);
    }

    public function create(Request $request){
        $transaction_types = TransactionType::where('expense', true)->where('is_active', true)->get();
        $agents = Agent::where('is_active', true)->get();
        return view('transactions.create', [
            'transaction_types' => $transaction_types,
            'agents' => $agents,
            'vehicle' => $request->vehicle,
            'is_active' => 'true'
        ]);
    }

    public function store(Request $request){
        $message = __('messages.transaction.created.fail');
        $error = true;

        DB::transaction(function () use($request, &$message, &$error){
            $support = $request->file('support');
            if(!is_null($request->is_active)){
                Vehicle::where('id', $request->vehicle)->update([
                    'is_active' => $request->is_active
                ]);
            }
            Transaction::create([
                'vehicle_id' => $request->vehicle,
                'transaction_type' => $request->transaction_type,
                'value' => $request->value,
                'date' => $request->date,
                'support' => is_null($support) ? null : $support->store('transactions', 'public'),
                'agent_id' => $request->agent,
                'commission' => $request->commission,
                'user_id' => Auth::user()->id
            ]);

            $message = trans('messages.transaction.created.done');
            $error = false;
        });

        return redirect()->route('vehicle.show', Vehicle::find($request->vehicle))->with([
            'error' => $error,
            'message' => $message
        ]);
    }
}
