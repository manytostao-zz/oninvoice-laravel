<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->decimal('amount', 10, 2)->comment('Payment amount.');
            $table->longText('note')->nullable()->default(NULL)->comment('Payment note.');
            $table->integer('invoice_id')->comment('Payment invoice reference.');
            $table->integer('payment_method_id')->comment('Payment method reference.');

            $table->foreign('payment_method_id')->references('id')->on('invoice')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
        });

        Schema::drop('payment');
    }
}