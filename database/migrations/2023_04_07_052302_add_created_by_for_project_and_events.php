<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByForProjectAndEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('project_createdby')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('events_createdby')->nullable();
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
            $table->dropColumn('project_createdby');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('events_createdby');
        });
    }
}
