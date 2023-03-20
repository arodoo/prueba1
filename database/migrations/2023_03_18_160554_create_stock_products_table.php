<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('producto_id')->unsigned();
            $table->string('talla');
            $table->integer('stock')->unsigned();
            $table->foreign('producto_id')->references('id')->on('products')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('stock_products');
    }
}
