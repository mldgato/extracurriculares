<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Directivo']);
        $role2 = Role::create(['name' => 'Coordinador']);
        $role3 = Role::create(['name' => 'Encargado']);


        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.cycles.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.cycles.order'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.levels.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.levels.order'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.grades.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.grades.order'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.sections.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sections.order'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.classroom.index'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.students.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.students.show'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.profile'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.activities.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.activities.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.activities.registrations'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.activities.presences'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.activities.enrolled'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.activities.assisted'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.activities.register'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.activities.students'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.activities.attendance'])->syncRoles([$role1, $role3]);

    }
}
