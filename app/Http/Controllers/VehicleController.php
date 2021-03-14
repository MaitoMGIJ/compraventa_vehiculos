<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index(){
        return view('vehicles.index');
    }

    public function show($id){
        return Vehicle::find($id);
    }

    public function create(){
        $vehicle_types = VehicleType::all();
        $transaction_types = TransactionType::where('entry', true)->where('is_active', true)->get();
        $agents = Agent::where('is_active', true)->get();
        return view('vehicles.create', [
            'vehicle_types' => $vehicle_types,
            'transaction_types' => $transaction_types,
            'agents' => $agents
        ]);
    }

    public function store(Request $request){
        DB::transaction(function () use($request){

            $photo = $request->file('photo');
            $support = $request->file('support');

            $vehicle_id = Vehicle::create([
                'license' => $request->license,
                'type' => $request->vehicle_type,
                'brand' => $request->brand,
                'reference' => $request->reference,
                'model' => $request->model,
                'color' => $request->color,
                'photo' => $photo->store('vehicles', 'public'),
                'comment' => $request->comment
            ])->id;

            Transaction::create([
                'vehicle_id' => $vehicle_id,
                'transaction_type' => $request->transaction_type,
                'value' => $request->value,
                'date' => $request->date,
                'support' => $support->store('transactions', 'public'),
                'agent_id' => $request->agent,
                'commission' => $request->commission,
                'user_id' => Auth::user()->id
            ]);
        });
        return redirect()->route('vehicle.index');
    }
}
