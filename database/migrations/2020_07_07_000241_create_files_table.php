<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('file_parent_id')->nullable();
            $table->foreign('file_parent_id')
                ->references('id')
                ->on('files');
            $table->bigInteger('size')->nullable();
            $table->boolean('is_directory')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->text('path')->unique();

            # UNIX permission style : owner (private), group (protected),  all (public)
            # 4 : read
            # 2 : write
            # 1 : execute

            $table->char('permission', 3)->default(755);
            $table->integer('owner_id');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('files');
    }
}
