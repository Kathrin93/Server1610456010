<?php

namespace App\Http\Controllers;


use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use App\Book;
use App\Order;
use App\Orderlog;
use App\User;


class OrderController extends Controller
{
    //
    //
    public function index() {
        $orders = Order::with(['books', 'orderlogs', 'user'])
            ->orderBy('user_id', 'desc')
            ->get();
        return $orders;
    }


    public function findByID (int $id) {
        $order = Order::where('id', $id)
            ->with(['books','orderlogs','user'])
            ->first();
        return $order;
    }

    /**
     * create new order
     */

    public function save(Request $request) : JsonResponse{
        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try {
            $order = Order::create($request->all());


            //save first orderlog
            //'time','public_comment','comment', 'state', 'username'
            // 0 = offen; 1 = bezahlt; 2 = versendet; 3 = storniert;

            $current_username = User::find($request["user_id"])->name;



            $ol = Orderlog::create([
                        'time' => new \DateTime(),
                        'public_comment' => "Neue Bestellung abgeschickt",
                        'comment' => "new order",
                        'state' => 0,
                        'username' => $current_username
            ]);


            //assign orderlog to order
            $order->orderLogs()->save($ol);



            //save books
           // 'isbn','title','subtitle','published', 'rating', 'description', 'price','user_id'



            if($request['books'] && is_array($request['books'])){

                $arrayofIsbns = [];

                foreach ($request['books'] as $book){
                    array_push($arrayofIsbns, $book['isbn']);
                }

                $occurencesofBooks = array_count_values($arrayofIsbns);

                foreach ($request['books'] as $book){

                    $amount = $book['amount'];

                    $book = Book::firstOrNew([
                        'isbn' => $book['isbn'],
                        'title' => $book['title'],
                        'subtitle' => $book['subtitle'],
                        'published' => $book['published'],
                        'rating' => $book['rating'],
                        'description' => $book['description'],
                        'price' => $book['price'],
                        'user_id' => $book['user_id']
                    ]);


                    //assign image to book
                    $order->books()->save($book, array(
                        'price' => $book['price'],
                        'amount' => $amount,
                        'title' => $book['title']
                    ));



                }
            }


            DB::commit();
            return response()->json($order,201);


        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json('saving order fails' . $e->getMessage(), 420);
        }

    }



    public function updateState(Request $request, int $id) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $order = Order::with(['books', 'orderlogs', 'user'])
                ->where('id', $id)->first();

            $order->update($request->all());


            if ($order != null) {
                $request = $this->parseRequest($request);

                $order->state = ($request['state']);
                $order->save;

            }


            $current_username = User::find($request["user_id"])->name;



            $ol = Orderlog::create([
                'time' => new \DateTime(),
                'public_comment' => ($request['public_comment']),
                'comment' => ($request['comment']),
                'state' => ($request['state']),
                'username' => $current_username
            ]);


            //assign orderlog to order
            $order->orderLogs()->save($ol);



            DB::commit();
            $order1 = Order::with(['books', 'orderlogs', 'user'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($order1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating book failed: " . $e->getMessage(), 420);

        }
    }


    private function parseRequest (Request $request) : Request {
        $date = new \DateTime($request->time);
        $request['time'] = $date;
        return $request;
    }
}
