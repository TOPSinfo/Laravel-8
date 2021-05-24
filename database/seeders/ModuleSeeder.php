<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modules = config('params.default_module');

        foreach ($modules as $module)
        {
            DB::table('modules')->insert([
                'name' => $module,
                'created_at' => Carbon::now(),
            ]);
        }

    }
}
