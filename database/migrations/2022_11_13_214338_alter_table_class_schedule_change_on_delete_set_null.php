<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClassScheduleChangeOnDeleteSetNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['room_id']);
            $table->foreignId('teacher_id')->change()->nullable()->constrained('teachers')->onDelete('set null');
            $table->foreignId('subject_id')->change()->nullable()->constrained('subjects')->onDelete('set null');

            $table->foreignId('room_id')->change()->references('id')->on('rooms')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
