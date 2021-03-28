<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'vehicle-list',
            'vehicle-create',
            'vehicle-edit',
            'vehicle-delete',
            'transaction-list',
            'transaction-create',
            'transaction-edit',
            'transaction-delete',
            'earnings-show',
            'user-create',
            'user-list',
            'user-edit',
            'user-delete',
            'reports-show',
            'report-transaction-show',
            'report-vehicle-active-show',
            'report-vehicle-inactive-show',
            'report-vehicle-history-show',
            'report-commission-show',
            'report-top-show',
            'report-inventory-show',
            'report-balance-show',
            'report-expense-show',
            'report-pawn-show'
         ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = User::create([
            'name' => 'Leo Motos Administrador',
            'email' => 'administrador@leomotos.com',
            'username' => 'administrador',
            'password' => bcrypt('Leomotos2021.')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Role::create(['name' => 'Registro']);

        Role::create(['name' => 'Consulta']);
    }
}
