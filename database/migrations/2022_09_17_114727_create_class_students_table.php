<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_students', function (Blueprint $table) {

            $table->foreignId('classSchedule_id')->constrained('class_schedules');
            $table->foreignId('student_id')->constrained('students');

            $table->tinyInteger('status')->comment('StatusClassStudentEnums')->default(0);
            $table->string('payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_students');
    }
}
