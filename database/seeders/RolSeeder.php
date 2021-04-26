<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $supervisor = Role::create(['name' => 'Supervisor']);
        $cashier = Role::Create(['name' => 'Cashier']);

        Permission::create(['name' => 'admin.index'])->syncRoles([$admin, $supervisor]);

        Permission::create(['name' => 'admin.categories.index'])->assignRole($admin);
        Permission::create(['name' => 'admin.categories.create'])->assignRole($admin);
        Permission::create(['name' => 'admin.categories.edit'])->assignRole($admin);
        Permission::create(['name' => 'admin.categories.destroy'])->assignRole($admin);

        Permission::create(['name' => 'admin.users.index'])->assignRole($admin);
        Permission::create(['name' => 'admin.users.create'])->assignRole($admin);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($admin);
        Permission::create(['name' => 'admin.users.destroy'])->assignRole($admin);

        Permission::create(['name' => 'admin.reports.index'])->assignRole($supervisor);

        Permission::create(['name' => 'shifts.show'])->assignRole($cashier);
        Permission::create(['name' => 'shifts.callNext'])->assignRole($cashier);
        Permission::create(['name' => 'shifts.callAgain'])->assignRole($cashier);

        
    }
}
