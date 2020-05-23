<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('category');
            $table->string('location');
            $table->longText('description');
            $table->double('price',10,2);
            $table->string('bar_code');
            $table->double('quantity',10,2);
            $table->string('unit_of_measure');
            $table->string('status');
            $table->string('photo');
            $table->string('user_id');
            $table->longText('extra');
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
        Schema::dropIfExists('products');
    }
}
