<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;

    protected $fillable = [
            'property_id',
            'as_vacant',
            'as_improved',
            'legally_permissible',
            'legally_permissible_exp',
            'physically_feasible',
            'physically_feasible_exp',
            'financially_feasible',
            'financially_feasible_exp',
            'hbu_general_comments',
            'foundation',
            'floor',
            'external_walls',
            'internal_walls',
            'windows',
            'doors',
            'ceiling',
            'roof',
            'physical_deterioration',
            'functional_obsolesce',
            'external_obsolesce',
            'externalities',
            'lease_type',
            'annual_rent_increase',
            'passing_rent',
            'market_rent',
            'other_income_sources',
            'other_income_amount',
            'land_value',
            'value_per_ha',
            'improvement_value',
            'value_per_m2',
            'property_value',
            'reserve_price',
            'cap_rate',
            'yield_rate',
            'discount_rate',
            'vacancy_rates',
            'irr',
            'operating_cost_ration',
            'purpose_of_valution',
            'date_of_inspection',
            'date_of_valuation',
            'primary_valuation_method',
            'secondary_valuation_method',
            'means_of_property_acquisition',
    ];

    public function property () {
        return $this->belongsTo(Property::class);
    }
}
