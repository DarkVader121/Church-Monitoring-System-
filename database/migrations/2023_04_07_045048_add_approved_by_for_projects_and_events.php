<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByForProjectsAndEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('project_approvedby')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('events_approvedby')->nullable();
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
            $table->dropColumn('project_approvedby');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('events_approvedby');
        });
    }
}