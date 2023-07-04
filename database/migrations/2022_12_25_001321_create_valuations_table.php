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
        Schema::create('valuations', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->string('as_vacant');
            $table->string('as_improved');
            $table->string('legally_permissible');
            $table->string('legally_permissible_exp');
            $table->string('physically_feasible');
            $table->string('physically_feasible_exp');
            $table->string('financially_feasible');
            $table->string('financially_feasible_exp');
            $table->string('hbu_general_comments');
            $table->string('foundation');
            $table->string('floor');
            $table->string('external_walls');
            $table->string('internal_walls');
            $table->string('windows');
            $table->string('doors');
            $table->string('ceiling');
            $table->string('roof');
            $table->integer('physical_deterioration');
            $table->integer('functional_obsolesce');
            $table->integer('external_obsolesce');
            $table->integer('externalities');
            $table->string('lease_type');
            $table->double('annual_rent_increase');
            $table->double('passing_rent');
            $table->double('market_rent');
            $table->string('other_income_sources');
            $table->double('other_income_amount');
            $table->double('land_value');
            $table->double('value_per_ha');
            $table->double('improvement_value');
            $table->double('value_per_m2');
            $table->double('property_value');
            $table->double('reserve_price');
            $table->double('cap_rate');
            $table->double('yield_rate');
            $table->double('discount_rate');
            $table->double('vacancy_rates');
            $table->double('irr');
            $table->double('operating_cost_ration');
            $table->string('purpose_of_valution');
            $table->date('date_of_inspection');
            $table->date('date_of_valuation');
            $table->string('primary_valuation_method');
            $table->string('secondary_valuation_method');
            $table->string('means_of_property_acquisition');
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
        Schema::dropIfExists('valuations');
    }
};
