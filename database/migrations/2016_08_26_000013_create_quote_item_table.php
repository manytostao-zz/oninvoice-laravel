<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->decimal('price', 10, 4)->comment('Quote item price.');
            $table->decimal('quantity', 10, 4)->comment('Quote item quantity.');
            $table->integer('quote_id')->unsigned()->comment('Quote item invoice reference.');
            $table->integer('product_id')->unsigned()->comment('Quote item product reference.');
            $table->integer('tax_id')->unsigned()->comment('Quote item tax reference.');
            $table->timestamps();

            $table->foreign('quote_id', 'quote_item_quote_fk')->references('id')->on('quote')->onDelete('no action')->onUpdate('no action');
            $table->foreign('product_id', 'quote_item_product_fk')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_item', function (Blueprint $table) {
            $table->dropForeign(['quote_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::drop('quote_item');
    }
}