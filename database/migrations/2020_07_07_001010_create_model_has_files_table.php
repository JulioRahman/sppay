<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_files', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->integer('model_id');
            $table->bigInteger('file_id');
            $table->foreign('file_id')
                ->references('id')
                ->on('files');
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
        Schema::dropIfExists('model_has_files');
    }
}
