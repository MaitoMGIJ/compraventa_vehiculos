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

    public function show(Vehicle $vehicle){
        return view('vehicles.show', [
            'vehicle' => $vehicle
            ]);
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
        $message = __('messages.vehicle.created.fail');
        $error = true;
        DB::transaction(function () use($request, &$message, &$error){

            $photo = $request->file('photo');
            $support = $request->file('support');

            $vehicle = Vehicle::create([
                'license' => $request->license,
                'type' => $request->vehicle_type,
                'brand' => $request->brand,
                'reference' => $request->reference,
                'model' => $request->model,
                'color' => $request->color,
                'photo' => $photo->store('vehicles', 'public'),
                'comment' => $request->comment
            ]);

            Transaction::create([
                'vehicle_id' => $vehicle->id,
                'transaction_type' => $request->transaction_type,
                'value' => $request->value,
                'date' => $request->date,
                'support' => $support->store('transactions', 'public'),
                'agent_id' => $request->agent,
                'commission' => $request->commission,
                'user_id' => Auth::user()->id
            ]);

            $message = trans('messages.vehicle.created.done', ['license' => $vehicle->license]);
            $error = false;
        });
        return redirect()->route('vehicle.index')->with([
            'error' => $error,
            'message' => $message
        ]);
    }

}
