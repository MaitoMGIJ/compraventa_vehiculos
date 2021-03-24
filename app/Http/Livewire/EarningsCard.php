<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EarningsCard extends Component
{
    public $earnings;

    public function render()
    {
        return view('livewire.earnings-card', [
            'earnings' => $this->earnings
        ]);
    }
}
