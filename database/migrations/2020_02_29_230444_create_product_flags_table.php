<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('product_id');
            $table->string('customer_id');
            $table->longText('reason');
            $table->boolean('blacklisted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_flags');
    }
}
