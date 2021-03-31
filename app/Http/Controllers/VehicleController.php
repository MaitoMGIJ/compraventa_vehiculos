<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Agent;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleReference;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehicleController extends Controller
{

    public function __construct(){
        $this->middleware('permission:vehicle-list|vehicle-create');
        $this->middleware('permission:vehicle-list', ['only' => ['show', 'index']]);
        $this->middleware('permission:vehicle-create', ['only' => ['create', 'store']]);
        //$this->middleware('role:Admin|Registro|Consulta', ['only' => ['index', 'show', 'create', 'store']]);
        //$this->middleware('role:Consulta', ['only' => ['index', 'show']]);
    }

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

    public function store(VehicleRequest $request){
        $message = __('messages.vehicle.created.fail');
        $error = true;
        DB::transaction(function () use($request, &$message, &$error){

            $photo = $request->file('photo');
            $support = $request->file('support');

            $referenceSearch = Str::upper($request->reference);

            $reference = VehicleReference::where('description', '=', $referenceSearch)
                            ->where('brand', '=', $request->brand)
                            ->get()
                            ->first();

            if($reference){
                $referenceId = $reference->id;
            }else{
                $referenceId = VehicleReference::create([
                    'description' => $referenceSearch,
                    'brand' => $request->brand,
                    'is_active' => true
                ])->id;
            }

            $vehicle = Vehicle::create([
                'license' => Str::upper($request->license),
                'type' => $request->vehicle_type,
                'brand' => $request->brand,
                'reference' => $referenceId,
                'model' => $request->model,
                'color' => Str::ucfirst($request->color),
                'technomechanical_expiration' => $request->technomechanical_expiration,
                'insurance_expiration' => $request->insurance_expiration,
                'photo' => $photo->store('vehicles', 'public'),
                'comment' => Str::ucfirst($request->comment)
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
