<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypeConfStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type_conf_status', function (Blueprint $table) {
            $table->increments('id')->comment('Table identifier.');
            $table->integer('document_type_conf_id')->comment('Document type configuration reference.');
            $table->integer('document_type_status_id')->comment('Document type state reference.');
            $table->timestamps();

            $table->foreign('document_type_conf_id', 'document_type_comf_fk')->references('id')->on('document_type_conf')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['document_type_conf_id']);
        });

        Schema::drop('document_type_conf_status');
    }
}