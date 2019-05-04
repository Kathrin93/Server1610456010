<?php

use Illuminate\Database\Seeder;
use App\Book;


class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::all()->first();

        $book = new Book;

        $book->title = "Herr der Ringe";
        $book->subtitle = "Die Gefährten";
        $book->isbn = "123456789";
        $book->rating = 10;
        $book->description = "Erster Teil ... ";
        $book->published = new DateTime();
        $book->price = 5;
        $book->user()->associate($user);
        $book->save();

        $authors = App\Author::all()->pluck("id");
        $book->authors()->sync($authors);
        //das save ist hier sehr wichtig, ansonsten würden die authoren nicht in der Datenbank speichern
        //save // update sind Persetierungsmethoden für die Datenbank
        $book->save();

        $book2 = new Book;

        $book2->title = "Herr der Ringe 2";
        $book2->subtitle = "Die zwei Türme";
        $book2->isbn = "1523456789";
        $book2->rating = 10;
        $book2->description = "Zweiter Teil ... ";
        $book2->price = 15;
        $book2->published = new DateTime();
        //map existing user to book
        $book2->user()->associate($user);
        $book2->save();
        $book2->authors()->sync($authors);
        $book2->save();

        $book3 = new Book;

        $book3->title = "Game of Thrones 1";
        $book3->subtitle = "Der Winter naht";
        $book3->isbn = "1523496789";
        $book3->rating = 10;
        $book3->description = "Der Winter naht ... ";
        $book3->price = 30;
        $book3->published = new DateTime();
        //map existing user to book
        $book3->user()->associate($user);
        $book3->save();
        $book3->authors()->sync($authors);
        $book3->save();

        $book4 = new Book;
        $book4->title = "Game of Thrones 2";
        $book4->subtitle = "Unser ist der Zorn";
        $book4->isbn = "1663456789";
        $book4->rating = 9;
        $book4->description = "Zweiter Teil ... ";
        $book4->price = 33;
        $book4->published = new DateTime();
        //map existing user to book
        $book4->user()->associate($user);
        $book4->save();
        $book4->authors()->sync($authors);
        $book4->save();


        $book5 = new Book;
        $book5->title = "Game of Thrones 3";
        $book5->subtitle = "Hört mich Brüllen";
        $book5->isbn = "1523996789";
        $book5->rating = 8;
        $book5->description = "Dritter Teil ... ";
        $book5->price = 40;
        $book5->published = new DateTime();
        //map existing user to book
        $book5->user()->associate($user);
        $book5->save();
        $book5->authors()->sync($authors);
        $book5->save();


        $book6 = new Book;
        $book6->title = "Game of Thrones 4";
        $book6->subtitle = "Hoch hinaus";
        $book6->isbn = "1523766789";
        $book6->rating = 10;
        $book6->description = "Zweiter Teil ... ";
        $book6->price = 35;
        $book6->published = new DateTime();
        //map existing user to book
        $book6->user()->associate($user);
        $book6->save();
        $book6->authors()->sync($authors);
        $book6->save();


        $image1 = new App\Image();
        $image1->title = "Cover 1";
        $image1->url = "https://m.media-amazon.com/images/I/51Q832vk98L._AC_UL872_FMwebp_QL65_.jpg";
        $image1->book()->associate($book);
        $image1->save();

        $image2 = new App\Image();
        $image2->title = "Cover 1";
        $image2->url = "https://m.media-amazon.com/images/I/51smfUvItSL._AC_UL872_FMwebp_QL65_.jpg";
        $image2->book()->associate($book2);
        $image2->save();


        $image3 = new App\Image();
        $image3->title = "Cover 3";
        $image3->url = "https://m.media-amazon.com/images/I/51lqO729RDL._AC_UL872_FMwebp_QL65_.jpg";
        $image3->book()->associate($book3);
        $image3->save();

        $image4 = new App\Image();
        $image4->title = "Cover 4";
        $image4->url = "https://m.media-amazon.com/images/I/51VzAfeLcpL._AC_UL872_FMwebp_QL65_.jpg";
        $image4->book()->associate($book4);
        $image4->save();

        $image5 = new App\Image();
        $image5->title = "Cover 5";
        $image5->url = "https://m.media-amazon.com/images/I/51bP+zWy1sL._AC_UL872_FMwebp_QL65_.jpg";
        $image5->book()->associate($book5);
        $image5->save();

        $image6 = new App\Image();
        $image6->title = "Cover 6";
        $image6->url = "https://m.media-amazon.com/images/I/A10w48BPhCL._AC_UL872_FMwebp_QL65_.jpg";
        $image6->book()->associate($book6);
        $image6->save();




    }
}
