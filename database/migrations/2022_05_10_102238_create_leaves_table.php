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
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id');
            $table->tinyInteger('leave_type');
            $table->tinyInteger('half_leave_type');
            $table->string('subject');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->tinyInteger('leave_status')->default('0');//pending
            $table->longText('message');
            $table->tinyInteger('approve')->default('0'); 
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
        Schema::dropIfExists('leaves');
    }
};
