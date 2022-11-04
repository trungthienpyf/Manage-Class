<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();

            $table->timestamp('time_start');
            $table->timestamp('time_end');
            $table->tinyInteger('status')->comment('StatusClassScheduleEnums')->default(0);
            $table->tinyInteger('time_line')->comment('TimeLineEnums')->default(0);

            $table->tinyInteger('weekdays')->comment('WeekDaysEnums');
            $table->tinyInteger('shift')->comment('ShiftEnums');
            $table->integer('target')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');

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
        Schema::dropIfExists('class_schedules');
    }
}
