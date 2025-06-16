<?php

namespace Database\Seeders;

use Domain\Permissions\Models\Permission;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@example.com')->exists()) {
            $user=User::factory()->create([
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
            ]);
            $user->syncPermissions(Permission::all()->pluck('name')->toArray());
        }
        if (!User::where('email', 'user@example.com')->exists()) {
            $user=User::factory()->create([
                'name' => 'Test user',
                'email' => 'user@example.com',
            ]);
            $user->syncPermissions(['products.view', 'config.access', 'config.modify']);
        }


        User::factory(100)->create();

    }
}
