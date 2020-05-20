<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('nisn', 10)->primary();
            $table->string('nis', 9);
            $table->string('student_name');
            $table->foreignId('__class_id')->constrained()
                ->onDelete('restrict')->onUpdate('restrict');
            $table->text('address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('spp_id')->constrained();
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
        Schema::dropIfExists('students');
    }
}
