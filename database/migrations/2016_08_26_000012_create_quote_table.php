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
            $table->integer('currency_id')->unsigned()->comment('Quote currency reference.');
            $table->integer('doc_type_conf_id')->unsigned()->comment('Quote document type configuration.');
            $table->integer('doc_type_conf_status_id')->unsigned()->comment('Quote document type configuration status.');
            $table->integer('client_id')->unsigned()->comment('Quote client.');
            $table->integer('user_id')->unsigned()->comment('Quote user.');
            $table->timestamps();

            $table->foreign('currency_id', 'quote_currency_fk')->references('id')->on('currency')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_id', 'quote_doc_type_conf_fk')->references('id')->on('document_type_conf')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_status_id', 'quote_doc_type_conf_status_fk')->references('id')->on('document_type_conf_status')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['doc_type_conf_status_id']);
        });

        Schema::drop('quote');
    }
}