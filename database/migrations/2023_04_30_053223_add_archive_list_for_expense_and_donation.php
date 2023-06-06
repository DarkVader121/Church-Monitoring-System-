<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchiveListForExpenseAndDonation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('archive')->nullable();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->string('archive')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
}
