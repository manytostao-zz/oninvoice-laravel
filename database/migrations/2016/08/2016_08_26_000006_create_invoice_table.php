<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier');
            $table->string('code', 100)->comment('Invoice code.');
            $table->decimal('rate', 10, 7)->comment('Invoice rate.');
            $table->decimal('amount', 10, 2)->comment('Invoice total amount.');
            $table->decimal('balance', 10, 2)->comment('Invoice balance (balance = amount - SUM(payments)).');
            $table->longText('terms')->nullable()->default(NULL)->comment('Invoice terms.');
            $table->longText('footer')->nullable()->default(NULL)->comment('Invoice footer.');
            $table->integer('currency_id')->comment('Invoice currency reference.');
            $table->integer('doc_type_conf_id')->comment('Invoice document type configuration.');
            $table->integer('doc_type_conf_status')->comment('Invoice document type configuration status.');
            $table->integer('client_id')->comment('Invoice client.');
            $table->integer('user_id')->comment('Invoice user.');
            $table->timestamps();

            $table->foreign('currency_id', 'invoice_currency_fk')->references('id')->on('currency')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_id', 'invoice_doc_type_conf_fk')->references('id')->on('document_type_conf')->onDelete('no action')->onUpdate('no action');
            $table->foreign('doc_type_conf_status', 'invoice_doc_type_conf_status_fk')->references('id')->on('document_type_conf_status')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['doc_type_conf_id']);
            $table->dropForeign(['doc_type_conf_status']);
        });

        Schema::drop('invoice');
    }
}