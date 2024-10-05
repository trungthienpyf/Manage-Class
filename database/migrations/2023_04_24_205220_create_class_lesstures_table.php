<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLessturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_lesstures', function (Blueprint $table) {

            $table->foreignId('lessture_id')->constrained('lesstures')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('class_schedules')->onDelete('cascade');
            $table->primary(['lessture_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_lesstures');
    }
}
