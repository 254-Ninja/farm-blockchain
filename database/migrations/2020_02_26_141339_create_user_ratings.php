<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('customer_id');
            $table->string('user_id');
            $table->text('comment')->nullable();
            $table->integer('rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ratings');
    }
}
