<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'email' => 'admin@unknown.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('123456'),
            'is_admin' => 1
        ]);

        $role = Role::updateOrCreate(['name' => 'Administration']);

        $permissions = Permission::all();

        if ($permissions->count() > 0) {
            $permissionNames = $permissions->pluck('name');
            $role->syncPermissions($permissionNames);
        }

        $user->assignRole($role);
    }
}
