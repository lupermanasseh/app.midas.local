<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $staff = Role::create([
            'name'=>'Staff',
            'description'=>'Staff Role',
            'permissions'=>json_encode([
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'partial'=>true,
            ]),
        ]);

        $admin = Role::create([
            'name'=>'Admin',
            'description'=>'Admin Role',
            'permissions'=>json_encode([
                'create'=>true,
                'read'=>true,
                'update'=>true,
            ]),
        ]);

        $accounts = Role::create([
            'name'=>'Accounts',
            'description'=>'Accounts Role',
            'permissions'=>json_encode([
                'create'=>true,
                'update'=>true,
                'read'=>true,
                'all'=>true,
            ]),
        ]);
    }
}
