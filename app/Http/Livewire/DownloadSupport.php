<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DownloadSupport extends Component
{
    public $transaction;

    public function render()
    {
        return view('livewire.download-support');
    }
}
