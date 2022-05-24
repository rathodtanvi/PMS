<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendace', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('In_Entry')->nullable();
            $table->string('Out_Entry')->nullable();
            $table->date('Attendance_Date');
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
        Schema::dropIfExists('attendace');
    }
};
