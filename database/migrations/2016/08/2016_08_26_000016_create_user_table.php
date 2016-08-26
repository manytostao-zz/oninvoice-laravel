<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('middle_name', 255)->nullable()->default(NULL);
            $table->string('last_name', 255)->nullable()->default(NULL);
            $table->string('email', 255);
            $table->string('password', 45);
            $table->string('company', 255)->nullable()->default(NULL);
            $table->longText('address')->nullable()->default(NULL);
            $table->decimal('phone', 10, 0)->nullable()->default(NULL);
            $table->decimal('fax', 10, 0)->nullable()->default(NULL);
            $table->decimal('movil', 10, 0)->nullable()->default(NULL);
            $table->tinyInteger('active')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}