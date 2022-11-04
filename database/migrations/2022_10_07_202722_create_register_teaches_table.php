<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterTeachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_teaches', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('weekdays')->comment('WeekDaysEnums');
            $table->tinyInteger('shift')->comment('ShiftEnums');
            $table->tinyInteger('status')->comment('StatusRegisterTeachEnums')->default(0);
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('classSchedule_id')->nullable()->constrained('class_schedules')->onDelete('cascade');
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
        Schema::dropIfExists('register_teaches');
    }
}
