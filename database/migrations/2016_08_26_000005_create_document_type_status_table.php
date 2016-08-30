<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypeStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type_status', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->string('description', 45)->comment('Document state description.');
            $table->timestamps();
        });

        Schema::table('document_type_conf_status', function (Blueprint $table) {
            $table->foreign('document_type_status_id', 'document_type_status_fk')->references('id')->on('document_type_status')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_type_conf_status', function (Blueprint $table) {
            $table->dropForeign(['document_type_status_id']);
        });

        Schema::drop('document_type_status');
    }
}