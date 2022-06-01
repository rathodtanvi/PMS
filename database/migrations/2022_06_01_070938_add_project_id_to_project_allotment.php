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
        Schema::table('project_allotment', function (Blueprint $table) {
            $table->foreignId('project_id')->after('user_id');
            $table->string('technology_id')->after('project_id');
            $table->dropColumn('project_name');
            $table->dropColumn('technology_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_allotment', function (Blueprint $table) {
         
        });
    }
};
