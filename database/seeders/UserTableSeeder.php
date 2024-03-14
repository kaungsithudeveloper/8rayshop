<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $Admin = User::create([
            'name' => 'Myat',
            'username' => 'Myat',
            'email' => 'Myat@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $AssistantManager = User::create([
            'name' => 'kaung',
            'username' => 'kaung',
            'email' => 'kaung@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'employee',
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'user',
            'status' => 'active',
        ]);

        if (!Role::where('name', 'SuperAdmin')->exists()) {
            $superAdminRole = Role::create(['name' => 'SuperAdmin']);
            $AdminRole = Role::create(['name' => 'Admin']);
            $AssistantManagerRole = Role::create(['name' => 'Assistant Manager']);
        } else {
            $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        }

        if ($superAdminRole) {
            $SuperAdmin->assignRole($superAdminRole);
        }

        if ($AdminRole) {
            $Admin->assignRole($AdminRole);
        }

        if ($AssistantManagerRole) {
            $AssistantManager->assignRole($AssistantManagerRole);
        }


    }
}
