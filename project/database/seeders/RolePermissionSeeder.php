<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define roles
        $roles = [
            'admin' => [
                'manage_users',
                'manage_roles',
                'view_reports',
                'approve_candidates',
                'schedule_tests'
            ],
            'staff' => [
                'view_candidates',
                'evaluate_quiz',
                'schedule_tests'
            ],
            'candidate' => [
                'take_quiz',
                'upload_documents',
                'view_results'
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            // Create Role
            $role = Role::firstOrCreate(['name' => $roleName]);

            foreach ($permissions as $permissionName) {
                // Create Permission
                $permission = Permission::firstOrCreate(['name' => $permissionName]);

                // Attach Permission to Role
                $role->permissions()->syncWithoutDetaching([$permission->id]);
            }
        }
    }
}
