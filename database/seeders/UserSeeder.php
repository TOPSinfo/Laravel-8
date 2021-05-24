<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Way One
        //User::factory()->times(50)->create();

        // Way Two
        //UserDataFactory::times(50)->create();

       // Way Three
        /*
            $faker = Faker::create();
            foreach (range(1,10) as $index) {
                DB::table('users')->insert([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt('secret'),
                ]);
            }
       */

        // Way Four

       $superUser = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'super@admin.com',
                'password' => Hash::make(config('params.default_pass')),
                'user_role' => 1,
                'gender' => 'male',
                'created_at' => Carbon::now(),
            ]
        );

        $superUser->syncRoles(config('params.super_admin_role'));

        $adminUser = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make(config('params.default_pass')),
                'user_role' => 2,
                'gender' => 'male',
                'created_at' => Carbon::now(),
            ]
        );

        $adminUser->syncRoles(config('params.admin_role'));

    }
}
