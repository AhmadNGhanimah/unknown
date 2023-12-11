<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'read categories',
            'write categories',
            'read audios',
            'write audios',
            'read users',
            'write users',
            'read roles',
            'write roles',
        ];

        DB::transaction(function () use ($permissions) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate(['name' => $permission]);
            }
        });
    }
}
