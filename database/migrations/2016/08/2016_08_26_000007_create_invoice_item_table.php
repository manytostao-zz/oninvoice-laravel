<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->decimal('price', 10, 4)->comment('Invoice item price.');
            $table->decimal('quantity', 10, 4)->comment('Invoice item quantity.');
            $table->integer('invoice_id')->comment('Invoice item invoice reference.');
            $table->integer('product_id')->comment('Invoice item product reference.');
            $table->integer('tax_id')->comment('Invoice item tax reference.');

            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['invoice_id']);
        });

        Schema::drop('invoice_item');
    }
}