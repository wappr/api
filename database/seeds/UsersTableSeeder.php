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
        $user->name = 'Levi Durfee';
        $user->email = 'levi.durfee@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Evil Rudee';
        $user->email = 'levidurfee@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Alex Vance';
        $user->email = 'alexvance@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Alex Dong';
        $user->email = 'alexdong@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Alex Wrong';
        $user->email = 'alexdong@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Alexander Douglass';
        $user->email = 'adoug@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
