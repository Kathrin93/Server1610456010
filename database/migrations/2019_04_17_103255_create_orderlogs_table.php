<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time');
            $table->string('public_comment')->nullable();
            $table->string('comment');
            // 0 = offe; 1 = bezahlt; 2 = versendet; 3 = storniert;
            $table->integer('state')->default('0');
            $table->string('username');

            $table->timestamps();


            //fk field for relation - model name lowercase + "_id"
            //unsigned --> ohne Vorzeichen (damit man den kompletten wertebereiche nutzen kann weil eine id keinen negativen wert annehmen kann
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderlogs');
    }
}
