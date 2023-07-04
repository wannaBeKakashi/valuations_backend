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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->double('land_size');
            $table->double('land_height');
            $table->double('land_width');
            $table->text('land_shape');
            $table->text('topography');
            $table->text('access');
            $table->text('view');
            $table->text('security');
            $table->text('utilities');
            $table->text('onsite_improvements');
            $table->text('offsite_improvements');
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
        Schema::dropIfExists('sites');
    }
};
