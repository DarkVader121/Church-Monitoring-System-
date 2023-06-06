<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatorDeciderArchiverNameIdStatusToMeeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('archiver_id')->nullable();
            $table->string('archiver_name')->nullable();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('creator_name')->nullable();
            $table->unsignedBigInteger('decider_id')->nullable();
            $table->string('decider_name')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting', function (Blueprint $table) {
            //
        });
    }
}
