<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->string('name', 45)->comment('Product name.');
            $table->longText('description')->comment('Product description.');
            $table->float('price')->comment('Product price.');
        });

        Schema::table('invoice_item', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_item', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::drop('product');
    }
}