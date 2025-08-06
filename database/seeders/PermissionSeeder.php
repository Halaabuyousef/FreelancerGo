<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected  $permissions = [
        ['name' => 'Show All Projects',     'guard_name' => 'web'],
        ['name' => 'Create new Project',    'guard_name' => 'admin'],
        ['name' => 'Edit Project',          'guard_name' => 'admin'],
        ['name' => 'Delete Project',        'guard_name' => 'freelancer'],

        ['name' => 'Show All questions',    'guard_name' => 'web'],
        ['name' => 'Create new Question',   'guard_name' => 'admin'],
        ['name' => 'Edit Question',         'guard_name' => 'admin'],
        ['name' => 'Delete Question',       'guard_name' => 'freelancer'],
    ];
    public function run(): void
    { {
            foreach ($this->permissions as $permission) {
                Permission::firstOrCreate($permission);
            }
        }
    }
}
