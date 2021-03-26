<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Transaction Types
        TransactionType::create([
            'description' => 'COMPRA',
            'entry' => true,
            'end' => false,
            'expense' => false,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'EMPEÑO',
            'entry' => true,
            'end' => false,
            'expense' => false,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'VENTA',
            'entry' => false,
            'end' => true,
            'expense' => false,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'LAVADA',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'CALCOMANIAS',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'MECANICA',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'LIBERACIÓN',
            'entry' => false,
            'end' => true,
            'expense' => false,
            'income'=> false,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'DEPOSITO EN EFECTIVO',
            'entry' => false,
            'end' => false,
            'expense' => false,
            'income'=> true,
            'withdrawal' => false
        ]);

        TransactionType::create([
            'description' => 'RETIRO EN EFECTIVO',
            'entry' => false,
            'end' => false,
            'expense' => false,
            'income'=> false,
            'withdrawal' => true
        ]);
    }
}
