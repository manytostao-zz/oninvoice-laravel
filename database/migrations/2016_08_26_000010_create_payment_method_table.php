<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->string('code', 5)->comment('Payment method code.');
            $table->string('description', 45)->comment('Payment description code.');
            $table->timestamps();
        });

        Schema::table('payment', function (Blueprint $table) {
            $table->foreign('payment_method_id', 'payment_method_fk')->references('id')->on('payment_method')->onDelete('no action')->onUpdate('no action');
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

        Schema::drop('payment_method');
    }
}