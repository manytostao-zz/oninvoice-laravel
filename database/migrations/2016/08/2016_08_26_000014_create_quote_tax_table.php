<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_tax', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->tinyInteger('after_item_tax')->default('1')->comment('Quote tax application: 1 - After item taxes, 0 - Before item taxes.');
            $table->integer('quote_id')->comment('Quote tax invoice reference.');
            $table->integer('quote_tax_id')->comment('Quote taxt tax reference.');

            $table->foreign('quote_id')->references('id')->on('quote')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_tax', function (Blueprint $table) {
            $table->dropForeign(['quote_id']);
        });

        Schema::drop('quote_tax');
    }
}