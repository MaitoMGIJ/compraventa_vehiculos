<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __contruct(){
        $this->middleware('role:Admin|Registro');
    }

    public function index(){
        $agents = Agent::all();
        return view('agents.index', [
            'agents' => $agents
        ]);
    }

    public function create(){
        return view('agents.create');
    }

    public function store(Request $request){
        $message = __('messages.user.created.fail');
        $error = true;

        $this->validate($request, [
            'name' => 'required',
        ]);

        Agent::create([
            'name' => $request->name
        ]);

        $message = __('messages.agent.created.done');
        $error = false;

        return redirect()->route('agents.index')
                        ->with([
                            'error' => $error,
                            'message' => $message
                        ]);

    }

    public function edit($id){

        $agent = Agent::find($id);

        return view('agents.edit', [
            'agent' => $agent
        ]);
    }

    public function update(Request $request, $id)
    {
        $message = __('messages.agent.updated.fail');
        $error = true;

        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();

        $agent = Agent::find($id);
        $agent->update($input);

        $message = __('messages.agent.updated.done');
        $error = false;

        return redirect()->route('agents.index')
                        ->with([
                            'error' => $error,
                            'message' => $message
                        ]);
    }
}
