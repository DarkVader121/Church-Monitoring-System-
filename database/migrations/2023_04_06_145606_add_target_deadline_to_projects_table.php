<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTargetDeadlineToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('projectTargetDeadline')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->date('eventsTargetDeadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('projectTargetDeadline');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('projectTargetDeadline');
        });
    }
}
