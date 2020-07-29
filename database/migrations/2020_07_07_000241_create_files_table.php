<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('id')
                ->default(DB::raw('uuid_generate_v1()'))
                ->primary();
            $table->string('name');
            $table->uuid('file_parent_id')->nullable();
            $table->bigInteger('size')->nullable();
            $table->boolean('is_directory')->default(false);
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

            # to avoid same name in a folder
            $table->unique(['file_parent_id', 'name']);
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
