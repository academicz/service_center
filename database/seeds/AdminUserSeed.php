<?php

use Illuminate\Database\Seeder;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\Registration();
        $user->name = 'admin';
        $user->phone = '00000';
        $user->email = 'admin@gmail.com';
        $user->address = 'address';
        $user->place = 'place';
        $user->pin_code = 000;
        $user->status = 1;
        $user->save();

        $admin = new \App\Models\Login();
        $admin->user_id = $user->id;
        $admin->email = 'admin';
        $admin->password = bcrypt('password');
        $admin->role = \App\Constants\Constants::$ADMIN_USER;
        $admin->save();
    }
}
