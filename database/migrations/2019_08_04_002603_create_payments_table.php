<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_id')->nullable();
            $table->string('mobile');
            $table->string('lat');
            $table->string('lng');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->bigInteger('payment_option_id')->unsigned()->nullable();
            $table->foreign('payment_option_id')->references('id')
                    ->on('payment_options');
            $table->decimal('grand_total');
            $table->decimal('delivery_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
