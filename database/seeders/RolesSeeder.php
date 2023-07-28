<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionsSeeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new PermissionsSeeder();
        $permission_list = $permission->data();

        $data = $this->data();
        foreach ($data as $value) {
            $role = Role::create([
                'name' => $value['name'],
            ]);

            if (in_array($value['name'], ['superadmin', 'admin'])) {
                foreach ($permission_list as $p) {
                    $role->givePermissionTo($p['name']);
                }
            }
        }
    }

    public function data()
    {
        return [
            ['name' => 'superadmin'],
            ['name' => 'admin'],
            ['name' => 'user'],
        ];
    }
}
