<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('class');
            $table->string('grade');
            $table->timestamps();

            $table->foreign('student_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });

        Schema::create('report_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('report_id')
                    ->references('id')
                    ->on('report_cards')
                    ->onDelete('cascade');

            $table->foreign('student_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_cards');
        Schema::dropIfExists('report_student');
    }
}
