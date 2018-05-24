<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Levi';
        $user->email = 'levi.durfee@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Levi';
        $user->email = 'levidurfee@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
