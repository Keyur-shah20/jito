<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('product', function (Blueprint $table) {
           $table->increments('id');
           $table->string('categories');

           $table->string('title');
           $table->string('slug')->nullable();
           $table->string('featured_image')->nullable();

            $table->string('gallery')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable()->default(1);
            $table->foreign('categories')->references('id')->on('category');
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
        //
        Schema::dropIfExists('product');
    }
}
