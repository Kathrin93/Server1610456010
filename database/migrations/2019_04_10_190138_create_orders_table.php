<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time');
            $table->decimal('netto')->default('0');
            $table->decimal('brutto')->default('0');


            // 0 = offe; 1 = bezahlt; 2 = versendet; 3 = storniert;
            $table->integer('state')->default('0');

            $table->timestamps();

            //fk field for relation - model name lowercase + "_id"
            //unsigned --> ohne Vorzeichen (damit man den kompletten wertebereiche nutzen kann weil eine id keinen negativen wert annehmen kann
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
