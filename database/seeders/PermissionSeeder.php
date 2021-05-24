<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Module;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission::factory()->times(10)->create();

        $permissions = config('params.default_permissions');

        foreach ($permissions as $key => $value)
        {
            $module = Module::where(['name' => $key])->pluck('id')[0];

            foreach ($value as $name)
            {
                $permission = Permission::create(
                    [
                        'name' => $name.'-'.$key,
                        'status' => 1,
                        'guard_name' => 'web',
                        'module_id' => $module,
                        'created_at' => Carbon::now(),
                    ]
                );

                $permission->syncRoles(config('params.admin_roles'));

            }

        }

    }
}
