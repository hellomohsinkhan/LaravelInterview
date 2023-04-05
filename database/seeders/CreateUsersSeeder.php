<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User;
        $user->firstname = 'Test';
        $user->lastname = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->phone_number = '9899941635';
        $user->password = bcrypt('password');
        $user->is_admin = 1;
        $user->save();
    }
}
