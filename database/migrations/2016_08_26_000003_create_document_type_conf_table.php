<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypeConfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type_conf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_type_id')->unsigned()->comment('Reference to the document type.');
            $table->string('description', 45)->comment('Document type configuration description.');
            $table->string('prefix', 10)->comment('Docuent type prefix.');
            $table->integer('digits')->comment('Document type consecutive digits ammount.');
            $table->integer('consecutive')->comment('Document type consecutive.');
            $table->tinyInteger('year')->default('0')->comment("Specifies wether the document type configuration will use the year. 1 - Will use it, 0 - Won't use it.");
            $table->tinyInteger('month')->default('0')->comment("Specifies wether the document type configuration will use the month. 1 - Will use it, 0 - Won't use it.");
            $table->timestamps();

            $table->foreign('document_type_id', 'document_type_fk')->references('id')->on('document_type')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_type_conf', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
        });

        Schema::drop('document_type_conf');
    }
}