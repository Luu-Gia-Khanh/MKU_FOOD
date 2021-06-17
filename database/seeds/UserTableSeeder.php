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
            'admin_name' => 'khanh admin',
            'admin_email' => 'khanhadmin@gmail.com',
            'admin_phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá',
            'admin_birthday' => '2000-08-07'
        ]);
        $manager = Admin::create([
            'admin_name' => 'khanh manager',
            'admin_email' => 'khanhmanager@gmail.com',
            'admin_phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá',
            'admin_birthday' => '2000-08-07'
        ]);
        $user = Admin::create([
            'admin_name' => 'khanh user',
            'admin_email' => 'khanhuser@gmail.com',
            'admin_phone' => '0368038738',
            'password' => md5('123456'),
            'admin_gender' => 'Nam',
            'admin_address' => 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá',
            'admin_birthday' => '2000-08-07'
        ]);

        $admin->roles()->attach($adminRoles);
        $manager->roles()->attach($managerRoles);
        $user->roles()->attach($userRoles);
        factory(App\Admin::class,10)->create();
    }
}
