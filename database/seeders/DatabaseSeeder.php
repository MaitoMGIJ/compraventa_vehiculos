<?php

namespace Database\Seeders;

use App\Models\Agent;
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

        $this->call([
            PermissionTableSeeder::class,
            VehicleTableSeeder::class,
            TransactionTypesTableSeeder::class
        ]);

        $agents = [
            'ASESOR GENERICO',
            'MAY',
            'BARBAS',
            'SERGIO',
            'CHUCHO'
        ];

        foreach($agents as $agent){
            Agent::create(['name' => $agent]);
        }
    }
}
