<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'sarahman23@student.oulu.fi',
            'password' => Hash::make('12345678'),
            // 'image' => $faker->image('public/uploads/user_avatar', 50, 50, null, false, true),
            'email_verified_at' => now(),
        ]);

        // user_profiles table
        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'username' => 'sarahman23',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'birthdate' => $faker->date,
        ]);

        // \App\Models\User::factory(10)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            ApplicationSettingsSeeder::class,
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);
    }
}
