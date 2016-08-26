<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('middle_name', 255)->nullable()->default(NULL);
            $table->string('last_name', 255)->nullable()->default(NULL);
            $table->string('email', 255);
            $table->string('company', 255)->nullable()->default(NULL);
            $table->longText('address')->nullable()->default(NULL);
            $table->decimal('phone', 10, 0)->nullable()->default(NULL);
            $table->decimal('fax', 10, 0)->nullable()->default(NULL);
            $table->decimal('movil', 10, 0)->nullable()->default(NULL);
            $table->integer('client_data_id')->nullable()->default(NULL)->comment('Client data associated to the user. If not null, the user is a client.');
            $table->timestamps();

            $table->foreign('client_data_id', 'user_data_client_data_fk')->references('id')->on('client_data')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('invoice', function (Blueprint $table) {
            $table->foreign('client_id', 'invoice_client_fk')->references('id')->on('user_data')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('quote', function (Blueprint $table) {
            $table->foreign('client_id', 'quote_client_fk')->references('id')->on('user_data')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_data', function (Blueprint $table) {
            $table->dropForeign(['client_data_id']);
        });

        Schema::table('invoice', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['client_id']);
        });

        Schema::drop('user_data');
    }
}