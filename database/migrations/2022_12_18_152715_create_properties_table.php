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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('property_number')->nullable();
            $table->integer('parent_valuation')->nullable();
            $table->string('owner_name');
            $table->string('property_type');
            $table->string('property_design');
            $table->string('construction_stage');
            $table->string('year_built');
            $table->integer('age');
            $table->string('eul');
            $table->string('rel');
            $table->string('measurements');
            $table->integer('no_rooms');
            $table->integer('no_of_bathrooms');
            $table->string('occupancy');
            $table->text('attributes');
            $table->string('title_deeds_available');
            $table->string('certificate_of_search_available');
            $table->string('encumbrances_available');
            $table->string('defects')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
