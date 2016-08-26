<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->string('name', 45)->comment('Tax name.');
            $table->decimal('percentage', 10, 2)->comment('Tax percentage.');
        });

        Schema::table('invoice_item', function (Blueprint $table) {
            $table->foreign('tax_id')->references('id')->on('tax')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('invoice_tax', function (Blueprint $table) {
            $table->foreign('invoice_tax_id')->references('id')->on('tax')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('quote_item', function (Blueprint $table) {
            $table->foreign('tax_id')->references('id')->on('tax')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('quote_tax', function (Blueprint $table) {
            $table->foreign('quote_tax_id')->references('id')->on('tax')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['tax_id']);
            $table->dropForeign(['invoice_tax_id']);
            $table->dropForeign(['tax_id']);
            $table->dropForeign(['quote_tax_id']);
        });

        Schema::drop('tax');
    }
}