<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier');
            $table->string('code', 100)->comment('Quote code.');
            $table->decimal('rate', 10, 7)->comment('Quote rate.');
            $table->decimal('amount', 10, 2)->comment('Quote total amount.');
            $table->longText('terms')->nullable()->default(NULL)->comment('Quote terms.');
            $table->longText('footer')->nullable()->default(NULL)->comment('Quote footer.');
            $table->integer('currency_id')->comment('Quote currency reference.');
            $table->integer('doc_type_conf_id')->comment('Quote document type configuration.');
            $table->integer('doc_type_conf_status')->comment('Quote document type configuration status.');
            $table->integer('client_id')->comment('Quote client.');
            $table->integer('user_id')->comment('Quote user.');

            $table->foreign('currency_id')->references('id')->on('currency')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_id')->references('id')->on('document_type_conf')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_status')->references('id')->on('document_type_conf_status')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote', function (Blueprint $table) {
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['doc_type_conf_id']);
            $table->dropForeign(['doc_type_conf_status']);
        });

        Schema::drop('quote');
    }
}