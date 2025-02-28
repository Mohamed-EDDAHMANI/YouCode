<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the four roles
        Role::create(['name' => 'candidat']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'cme']);
        Role::create(['name' => 'formateur']);
    }
}
