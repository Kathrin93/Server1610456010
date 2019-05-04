<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a1 = new \App\Author();
        $a1->firstName = "Max";
        $a1->lastName = "Maier";
        $a1->save();

        $a2 = new \App\Author();
        $a2->firstName = "Fritz";
        $a2->lastName = "Huber";
        $a2->save();

        $a3 = new \App\Author();
        $a3->firstName = "Heinz";
        $a3->lastName = "Gruber";
        $a3->save();
    }
}
