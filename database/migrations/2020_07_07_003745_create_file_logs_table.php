<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('performer_id');
            $table->string('action')->nullable();
            $table->bigInteger('file_id');
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->morphs('loggable');
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
        Schema::dropIfExists('file_logs');
    }
}
