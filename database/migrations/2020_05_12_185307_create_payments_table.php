<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operator_id');
            $table->string('student_nisn', 10);
            $table->foreignId('spp_id')->constrained();
            $table->date('payment_date');
            $table->integer('month_paid');
            $table->timestamps();

            $table->foreign('operator_id')->references('id')->on('users');
            $table->foreign('student_nisn')->references('nisn')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
