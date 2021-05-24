<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::factory()->times(10)->create();

        DB::table('roles')->insert([
            'name' => 'Super Admin',
            'status' => 1,
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'status' => 1,
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
        ]);


    }
}
