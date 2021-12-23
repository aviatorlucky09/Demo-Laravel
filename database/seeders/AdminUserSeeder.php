<?php

namespace Database\Seeders;

use App\Models\User\Admin;
use App\Models\User\AdminRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = AdminRole::find(1);
        if(!$role){
            $role = new AdminRole();
            $role->name = "Admin";
            $role->save();
        }


        $admin = Admin::find(1);
        if(!$admin){
            $admin = new Admin();
            $admin->role_id = $role->id;
            $admin->first_name = "admin";
            $admin->last_name = "admin";
            $admin->email ="admin@gmail.com";
            $admin->password = bcrypt('tester123');
            $admin->save();
        }

    }
}
