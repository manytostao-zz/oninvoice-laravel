<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_tax', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->tinyInteger('after_item_tax')->default('1')->comment('Invoice tax application: 1 - After item taxes, 0 - Before item taxes.');
            $table->integer('invoice_id')->comment('Invoice tax invoice reference.');
            $table->integer('invoice_tax_id')->comment('Invoice tax tax reference.');
            $table->timestamps();

            $table->foreign('invoice_id', 'invoice_tax_invoice_fk')->references('id')->on('invoice')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_tax', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']);
        });

        Schema::drop('invoice_tax');
    }
}