<?php

namespace Database\Seeders;

use App\Models\VehicleBrand;
use App\Models\VehicleReference;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        VehicleReference::create([
            'brand' => $kia,
            'description' => 'PICANTO'
        ]);

        VehicleReference::create([
            'brand' => $kia,
            'description' => 'SPORTAGE'
        ]);

        VehicleReference::create([
            'brand' => $chevrolet,
            'description' => 'SAIL'
        ]);

        VehicleReference::create([
            'brand' => $chevrolet,
            'description' => 'OPTRA'
        ]);

        VehicleReference::create([
            'brand' => $mazda,
            'description' => '3'
        ]);

        VehicleReference::create([
            'brand' => $mazda,
            'description' => '6'
        ]);
    }
}
