<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 'name', 'email', 'password', 'firstName', 'lastName', 'address', 'flag'
        // 0 == Shop Nutzer , 1 == admin Nutzer

        //Admin Benutze Seeder
        $user = new App\User();
        $user->name = 'admin';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('secret');

        $user->firstName = 'Kathrin';
        $user->lastName = 'Hofer';
        $user->address = 'Salzstraße 6, 4232 Hagenberg';
        $user->flag = 1;
        $user->save();


        //Shop Benutzer Seeder
        $user2 = new App\User();
        $user2->name = 'max_muster';
        $user2->email = 'test2@gmail.com';
        $user2->password = bcrypt('secret');

        $user2->firstName = 'Max';
        $user2->lastName = 'Mustermann';
        $user2->address = 'Salzstraße 6/2, 4232 Hagenberg';
        $user2->flag = 0;
        $user2->save();


        $user3 = new App\User();
        $user3->name = 'susi_sun';
        $user3->email = 'test3@gmail.com';
        $user3->password = bcrypt('secret');

        $user3->firstName = 'Susanne';
        $user3->lastName = 'Sonnenschien';
        $user3->address = 'Erlstenstraße 13, 3324 Euratsfeld';
        $user3->flag = 0;
        $user3->save();
    }
}
