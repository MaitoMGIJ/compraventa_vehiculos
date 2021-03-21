<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use Livewire\Component;

class ReportCommissionAgentDateForm extends Component
{
    public function render()
    {
        return view('livewire.report-commission-agent-date-form', [
            'agents' => Agent::all()
        ]);
    }
}
