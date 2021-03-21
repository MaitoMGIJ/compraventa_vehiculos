<?php

namespace App\Http\Livewire\Tables;

use App\Models\Transaction;
use App\Models\Vehicle;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Transactions extends LivewireDatatable
{
    public $initialDate;
    public $endDate;

    public function builder(){
        $initialDate = $this->params['initialDate'];
        $endDate = $this->params['endDate'];
        return Transaction::query()->between($initialDate, $endDate)
            ->leftJoin('vehicles', 'vehicles.id', '=', 'vehicle_id')
            ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transaction_type')
            ->orderBy('transactions.id');
    }

    public function columns()
    {
        return [
            Column::name('vehicles.license')
            ->label(__('tags.license'))
        ];
    }

}
