<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Orderlog;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = App\User::all()->first();

        $order = new Order;

        $order->time = new DateTime();
        $order->netto = 50.60;
        $order->brutto = 60.72;
        $order->brutto = 60.72;

        // 0 = offe; 1 = bezahlt; 2 = versendet; 3 = storniert;

        $order->state = 0;

        $ol = new Orderlog;
        $ol->time = new \DateTime();
        $ol->public_comment = "Neue Bestellung abgeschickt";
        $ol->comment = "new order";
        $ol->username = 'admin';

        $order->orderLogs()->save($ol);


        $order->user()->associate($user);
        $order->save();

        $books = App\Book::all()->pluck("id");
        $order->books()->sync($books);
        //das save ist hier sehr wichtig, ansonsten würden die authoren nicht in der Datenbank speichern
        //save // update sind Persetierungsmethoden für die Datenbank
        $order->save();

    }
}
