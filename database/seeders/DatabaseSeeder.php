<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $admin_super_user_id = (string) Str::orderedUuid();
        DB::table('users')->insert([
            'id' => $admin_super_user_id,
            'name' => env('ADMIN_SUPER_USER_NAME'),
            'email' => env('ADMIN_SUPER_USER_EMAIL'),
            'password' => Hash::make(env('ADMIN_SUPER_USER_EMAIL')),
        ]);
        
        $super_user_role_id = (string) Str::orderedUuid();
        DB::table('roles')->insert([
            'id' => $super_user_role_id,
            'role_title' => 'Super Admin'
        ]);

        $users_roles_id = (string) Str::orderedUuid();
        DB::table('users_roles')->insert([
            'id' => $users_roles_id,
            'user_id' => $admin_super_user_id,
            'role_id' => $super_user_role_id,
        ]);


    }
}
