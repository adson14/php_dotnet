<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->bigIncrements('incoming_id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('description',50);
            $table->decimal('value',8,2);
            $table->dateTime('date_incoming');
            $table->string('repeat',1);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('CASCADE');
            $table->foreign('account_id')->references('account_id')->on('accounts');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomings');
    }
}
