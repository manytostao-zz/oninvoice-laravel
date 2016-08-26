<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->string('code', 5)->comment('Currency code.');
            $table->string('description', 45)->comment('Currency description.');
            $table->string('symbol', 5)->comment('Currency symbol.');
            $table->tinyInteger('symbol_location')->default('1')->comment('Currency symbol location. 1 - Front, 0 - Rear.');
            $table->char('decimal_point', 1)->comment('Sign used to separate the decimal part of a currency value.');
            $table->char('thousands_separator', 1)->comment('Sign used to separate the milliards parts of a currency value.');
            $table->decimal('rate', 10, 7)->nullable()->default(NULL)->comment('Conversion rate of a currency regarding the base currency.');
            $table->tinyInteger('base')->default('0')->comment('Specifies wether the currency is the base used throughout the entire application. The rate of the other currencies will be in regards to this one. 1 - Base, 0 - Not base.');
            $table->timestamps();
        });

        Schema::table('client_data', function (Blueprint $table) {
            $table->foreign('currency_id', 'client_data_currency_fk')->references('id')->on('currency')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_data', function (Blueprint $table) {
            $table->dropForeign(['currency_id']);
        });

        Schema::drop('currency');
    }
}