<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define your permissions
        Permission::create(['name' => 'admin.menu','guard_name' => 'web','group_name' => 'admin']);
        Permission::create(['name' => 'admin.list','guard_name' => 'web','group_name' => 'admin']);
        Permission::create(['name' => 'admin.add','guard_name' => 'web','group_name' => 'admin']);
        Permission::create(['name' => 'admin.edit','guard_name' => 'web','group_name' => 'admin']);
        Permission::create(['name' => 'admin.delete','guard_name' => 'web','group_name' => 'admin']);

        Permission::create(['name' => 'blog.menu','guard_name' => 'web','group_name' => 'blog']);
        Permission::create(['name' => 'blog.list','guard_name' => 'web','group_name' => 'blog']);
        Permission::create(['name' => 'blog.add','guard_name' => 'web','group_name' => 'blog']);
        Permission::create(['name' => 'blog.edit','guard_name' => 'web','group_name' => 'blog']);
        Permission::create(['name' => 'blog.delete','guard_name' => 'web','group_name' => 'blog']);

        Permission::create(['name' => 'role.permission.menu','guard_name' => 'web','group_name' => 'role']);

        // Assign permissions to roles
        $superAdminRole = Role::findByName('SuperAdmin');

        // SuperAdmin has all permissions
        $superAdminRole->givePermissionTo('admin.menu');
        $superAdminRole->givePermissionTo('admin.list');
        $superAdminRole->givePermissionTo('admin.add');
        $superAdminRole->givePermissionTo('admin.edit');
        $superAdminRole->givePermissionTo('admin.delete');

        $superAdminRole->givePermissionTo('blog.menu');
        $superAdminRole->givePermissionTo('blog.list');
        $superAdminRole->givePermissionTo('blog.add');
        $superAdminRole->givePermissionTo('blog.edit');
        $superAdminRole->givePermissionTo('blog.delete');

        $superAdminRole->givePermissionTo('role.permission.menu');

    }
}
