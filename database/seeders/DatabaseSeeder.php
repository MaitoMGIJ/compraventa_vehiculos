<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\TransactionType;
use App\Models\VehicleBrand;
use App\Models\VehicleReference;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Users
        \App\Models\User::factory(1)->create();

        //Types
        $motorcycle_id = VehicleType::create([
            'description' => 'MOTO'
        ])->id;

        $car_id = VehicleType::create([
            'description' => 'CARRO'
        ])->id;

        //Brands
        $honda = VehicleBrand::create([
            'type' => $motorcycle_id,
            'description' => 'HONDA'
        ])->id;

        $qingqi = VehicleBrand::create([
            'type' => $motorcycle_id,
            'description' => 'QINGQI'
        ])->id;

        $suzuki = VehicleBrand::create([
            'type' => $motorcycle_id,
            'description' => 'SUZUKI'
        ])->id;

        $kia = VehicleBrand::create([
            'type' => $car_id,
            'description' => 'KIA'
        ])->id;

        $chevrolet = VehicleBrand::create([
            'type' => $car_id,
            'description' => 'CHEVROLET'
        ])->id;

        $mazda = VehicleBrand::create([
            'type' => $car_id,
            'description' => 'MAZDA'
        ])->id;

        //References
        VehicleReference::create([
            'brand' => $honda,
            'description' => 'CBF 150'
        ]);

        VehicleReference::create([
            'brand' => $honda,
            'description' => 'CBF 125'
        ]);

        VehicleReference::create([
            'brand' => $honda,
            'description' => 'CBF 160'
        ]);

        VehicleReference::create([
            'brand' => $qingqi,
            'description' => 'QM 125'
        ]);

        VehicleReference::create([
            'brand' => $qingqi,
            'description' => 'QM 150'
        ]);

        VehicleReference::create([
            'brand' => $suzuki,
            'description' => 'DR 200'
        ]);

        VehicleReference::create([
            'brand' => $suzuki,
            'description' => 'GIXXER 150'
        ]);

        //Transaction Types
        TransactionType::create([
            'description' => 'COMPRA',
            'entry' => true,
            'end' => false,
            'expense' => false,
            'income'=> false
        ]);

        TransactionType::create([
            'description' => 'EMPEÑO',
            'entry' => true,
            'end' => false,
            'expense' => false,
            'income'=> false
        ]);

        TransactionType::create([
            'description' => 'VENTA',
            'entry' => false,
            'end' => true,
            'expense' => false,
            'income'=> false
        ]);

        TransactionType::create([
            'description' => 'LAVADA',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income' => false
        ]);

        TransactionType::create([
            'description' => 'CALCOMANIAS',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income' => false
        ]);

        TransactionType::create([
            'description' => 'MECANICA',
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income' => false
        ]);

        //Agents
        Agent::factory(5)->create();

    }
}
