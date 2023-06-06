<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsForCreatorsAndApproversId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('approver_id')->nullable(); // Add an integer column called "approver_id"
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id')->nullable(); // Add an integer column called "approver_id"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('approver_id'); // Drop the "approver_id" column
        });
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('creator_id'); // Drop the "approver_id" column
        });
    }
}

