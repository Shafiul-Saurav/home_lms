<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('role')->truncate();
        // Create an admin role and assign all permission on it

        $adminPermissions = Permission::select('id')->get();

        Role::updateOrCreate([
            'role_name' => 'Super Admin',
            'role_slug' => 'super_admin',
            'role_note' => 'super admin has all permission',
            'is_deletable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'admin has limited permission',
            'is_deletable' => true,
        ]);

        Role::updateOrCreate([
            'role_name' => 'Moderator',
            'role_slug' => 'moderator',
            'role_note' => 'moderator has limited permission',
            'is_deletable' => true,
        ]);

        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'user has limited permission',
            'is_deletable' => true,
        ]);
    }
}
