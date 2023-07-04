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
        Schema::create('valuers', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('valuer_number')->nullable();
            $table->string('user_id')->nullable();
            $table->string('physical_address');
            $table->string('affiliation')->nullable();
            $table->enum('gender',['male','female']);
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
        Schema::dropIfExists('valuers');
    }
};
