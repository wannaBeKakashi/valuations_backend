<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'user_id' => (string) $this->user_id,
            'property_number' => $this->property_number,
            'owner_name' => $this->owner_name,
            'property_type' => $this->property_type,
            'property_design' => $this->property_design,
            'construction_stage' => $this->construction_stage,
            'year_built' => $this->year_built,
            'age' => $this->age,
            'eul' => $this->eul,
            'rel' => $this->rel,
            'measurements' => $this->measurements,
            'no_rooms' => $this->no_rooms,
            'no_of_bathrooms' => $this->no_of_bathrooms,
            'occupancy' => $this->occupancy,
            'attributes' => json_decode($this->attributes),
            'title_deeds_available' => $this->title_deeds_available,
            'certificate_of_search_available' => $this->certificate_of_search_available,
            'encumbrances_available' => $this->encumbrances_available,
            'media_url' => [
                'front_view' => $this->getFirstMediaUrl('front_views'),
                'back_view' => $this->getFirstMediaUrl('back_views'),
                'inside_view' => $this->getFirstMediaUrl('inside_views'),
                'floor_plan_1_view' => $this->getFirstMediaUrl('floor_plan_1_views'),
                'floor_plan_2_view' => $this->getFirstMediaUrl('floor_plan_2_views'),
                'floor_plan_3_view' => $this->getFirstMediaUrl('floor_plan_3_views'),
            ],
            'site' => [
                'id' => (string)$this->site->id,
                'land_size' => $this->site->land_size,
                'land_height' => $this->site->land_height,
                'land_width' => json_decode($this->site->land_width),
                'land_shape' => json_decode($this->site->land_shape),
                'topography' => json_decode($this->site->topography),
                'access' => json_decode($this->site->access),
                'view' => json_decode($this->site->view),
                'security' => json_decode($this->site->security),
                'utilities' => json_decode($this->site->utilities),
                'onsite_improvements' => json_decode($this->site->onsite_improvements),
                'offsite_improvements' => json_decode($this->site->offsite_improvements),
            ],
            'location' => [
                'id' => (string) $this->location->id,
                'district' => $this->location->district,
                'area' => $this->location->area,
                'google_map_link' => $this->location->google_map_link,
                'latitude' => $this->location->latitude,
                'longitude' => $this->location->longitude,
                'zone_category' => $this->location->zone_category,
                'zoning' => $this->location->zoning,
            ],
            'valuation' => [
                'id' => (string) $this->valuation->id,
                'as_vacant' => $this->valuation->as_vacant,
                'as_improved' => $this->valuation->as_improved,
                'legally_permissible' => $this->valuation->legally_permissible,
                'legally_permissible_exp' => $this->valuation->legally_permissible_exp,
                'physically_feasible' => $this->valuation->physically_feasible,
                'physically_feasible_exp' => $this->valuation->physically_feasible_exp,
                'financially_feasible' => $this->valuation->financially_feasible,
                'financially_feasible_exp' => $this->valuation->financially_feasible_exp,
                'hbu_general_comments' => $this->valuation->hbu_general_comments,
                'foundation' => $this->valuation->foundation,
                'floor' => $this->valuation->floor,
                'external_walls' => $this->valuation->external_walls,
                'internal_walls' => $this->valuation->internal_walls,
                'windows' => $this->valuation->windows,
                'doors' => $this->valuation->doors,
                'ceiling' => $this->valuation->ceiling,
                'roof' => $this->valuation->roof,
                'physical_deterioration' => $this->valuation->physical_deterioration,
                'functional_obsolesce' => $this->valuation->functional_obsolesce,
                'external_obsolesce' => $this->valuation->external_obsolesce,
                'externalities' => $this->valuation->externalities,
                'lease_type' => $this->valuation->lease_type,
                'annual_rent_increase' => $this->valuation->annual_rent_increase,
                'passing_rent' => $this->valuation->passing_rent,
                'market_rent' => $this->valuation->market_rent,
                'other_income_sources' => $this->valuation->other_income_sources,
                'other_income_amount' => $this->valuation->other_income_amount,
                'land_value' => $this->valuation->land_value,
                'value_per_ha' => $this->valuation->value_per_ha,
                'improvement_value' => $this->valuation->improvement_value,
                'value_per_m2' => $this->valuation->value_per_m2,
                'property_value' => $this->valuation->property_value,
                'reserve_price' => $this->valuation->reserve_price,
                'cap_rate' => $this->valuation->cap_rate,
                'yield_rate' => $this->valuation->yield_rate,
                'discount_rate' => $this->valuation->discount_rate,
                'vacancy_rates' => $this->valuation->vacancy_rates,
                'irr' => $this->valuation->irr,
                'operating_cost_ration' => $this->valuation->operating_cost_ration,
                'purpose_of_valution' => $this->valuation->purpose_of_valution,
                'date_of_inspection' => $this->valuation->date_of_inspection,
                'date_of_valuation' => $this->valuation->date_of_valuation,
                'primary_valuation_method' => $this->valuation->primary_valuation_method,
                'secondary_valuation_method' => $this->valuation->secondary_valuation_method,
                'means_of_property_acquisition' => $this->valuation->means_of_property_acquisition,
            ]
        ];
    }
}
