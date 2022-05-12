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
        Schema::create('daily_work_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id')->nullable();
            $table->string('user_id');
            $table->date('entry_date');
            $table->string('entry_duration');
            $table->tinyInteger('productive');
            $table->string('work_type')->default('new');
            $table->longText('description');
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
        Schema::dropIfExists('daily_work_entries');
    }
};
