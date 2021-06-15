<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
class UserTableSeeder extends Seeder
{

    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $managerRoles = Roles::where('name','manager')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            'name' => 'khanh admin',
            'admin_email' => 'khanhadmin@gmail.com',
            'phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Sóc Trăng',
            'admin_birthday' => '07/08/2000'
        ]);
        $manager = Admin::create([
            'name' => 'khanh manager',
            'admin_email' => 'khanhmanager@gmail.com',
            'phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Sóc Trăng',
            'admin_birthday' => '07/08/2000'
        ]);
        $user = Admin::create([
            'name' => 'khanh user',
            'admin_email' => 'khanhuser@gmail.com',
            'phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Sóc Trăng',
            'admin_birthday' => '07/08/2000'
        ]);

        $admin->roles()->attach($adminRoles);
        $manager->roles()->attach($managerRoles);
        $user->roles()->attach($userRoles);
        factory(App\Admin::class,10)->create();
    }
}
