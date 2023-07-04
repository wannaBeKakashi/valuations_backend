<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Property\PropertyResource;
use App\Models\Site;
use App\Models\Location;
use App\Models\Valuation;

class ValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $properties = Property::all();

        return PropertyResource::collection($properties);
    }
    public function  search(Request $request) {

        $fields  = $request->post();
       

        $properties = Property::join('valuations','valuations.property_id','properties.id')
                                ->join('sites','sites.property_id','properties.id')
                                ->join('locations','locations.property_id','properties.id');

        if(isset($fields['property_type']))
           $properties->where('properties.property_type',$fields['property_type']);

        if(isset($fields['district']))
          $properties->Where('locations.district',$fields['district']);

        if(isset($fields['purpose_of_valution']))
          $properties->Where('valuations.purpose_of_valution',$fields['purpose_of_valution']);

        if(isset($fields['area']))
            $properties->where('locations.area',$fields['area']);

        if(isset($fields['measure_style']))
            $properties->where('properties.measurements',strtoupper($fields['measure_style']));
         
          

        return PropertyResource::collection($properties->select('properties.*')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // return $request;

        $propertyRequest = (object) $request->property;
        $siteRequest = (object) $request->site;
        $locationRequest = (object) $request->location;
        $valuationaRequest = (object) $request->valuationa;
        $valuationbRequest = (object) $request->valuationb;
        $visualsRequest = (object) $request->visuals;

        $propertiesCollection = Property::orderBy('id', 'desc')->get();
        $prop_id = $propertiesCollection->first() ? $propertiesCollection->first()->id + 1 : 1;

        $property = Property::create([
            'user_id' => auth()->id(),
            'property_number' => $locationRequest->region[0].'/'.auth()->id().'/'.$prop_id,
            'owner_name' => $propertyRequest->owner_name,
            'property_type' => $propertyRequest->property_type,
            'property_design' => $propertyRequest->owner_name,
            'construction_stage' => $propertyRequest->construction_stage,
            'year_built' => $propertyRequest->year_built,
            'age' => $propertyRequest->age,
            'eul' => $propertyRequest->eul,
            'rel' => $propertyRequest->rel,
            'measurements' => $propertyRequest->measurements,
            'no_rooms' => $propertyRequest->no_rooms,
            'no_of_bathrooms' => $propertyRequest->no_of_bathrooms,
            'occupancy' => $propertyRequest->occupancy,
            'attributes' => json_encode($propertyRequest->attributes),
            'title_deeds_available' => $propertyRequest->title_deeds_available,
            'certificate_of_search_available' => $propertyRequest->certificate_of_search_available,
            'encumbrances_available' => $propertyRequest->encumbrances_available,
            // 'defects' => $propertyRequest->defects ? $propertyRequest->defects : "none",
        ]);

        if($property) {
            $location = $property->location()->create([
                // 'property_id' => $property->id,
                'district' => $locationRequest->district,
                'area' => $locationRequest->area,
                'google_map_link' => $locationRequest->google_map_link,
                'latitude' => $locationRequest->latitude,
                'longitude' => $locationRequest->longitude,
                'zone_category' => $locationRequest->zone_category,
                'zoning' => $locationRequest->zoning,
            ]);

            $site = $property->site()->create([
                // 'property_id' => $property->id,
                'land_size' => $siteRequest->land_size,
                'land_height' => $siteRequest->land_height,
                'land_width' => $siteRequest->land_width,
                'land_shape' => json_encode($siteRequest->land_shape),
                'topography' => json_encode($siteRequest->topography),
                'access' => json_encode($siteRequest->access),
                'view' => json_encode($siteRequest->view),
                'security' =>json_encode( $siteRequest->security),
                'utilities' => json_encode($siteRequest->utilities),
                'onsite_improvements' => json_encode($siteRequest->onsite_improvements),
                'offsite_improvements' => json_encode($siteRequest->offsite_improvements),
            ]);

            $valuation = $property->valuation()->create([
                // 'property_id' => $property->id,
                'as_vacant' => $valuationaRequest->as_vacant,
                'as_improved' => $valuationaRequest->as_improved,
                'legally_permissible' => $valuationaRequest->legally_permissible,
                'legally_permissible_exp' => $valuationaRequest->legally_permissible_exp,
                'physically_feasible' => $valuationaRequest->physically_feasible,
                'physically_feasible_exp' => $valuationaRequest->physically_feasible_exp,
                'financially_feasible' => $valuationaRequest->financially_feasible,
                'financially_feasible_exp' => $valuationaRequest->financially_feasible_exp,
                'hbu_general_comments' => $valuationaRequest->hbu_general_comments,
                'foundation' => $valuationaRequest->foundation,
                'floor' => $valuationaRequest->floor,
                'external_walls' => $valuationaRequest->external_walls,
                'internal_walls' => $valuationaRequest->internal_walls,
                'windows' => $valuationaRequest->windows,
                'doors' => $valuationaRequest->doors,
                'ceiling' => $valuationaRequest->ceiling,
                'roof' => $valuationaRequest->roof,
                'physical_deterioration' => $valuationaRequest->physical_deterioration,
                'functional_obsolesce' => $valuationaRequest->functional_obsolesce,
                'external_obsolesce' => $valuationaRequest->external_obsolesce,
                'externalities' => $valuationaRequest->externalities,

                'lease_type' => $valuationbRequest->lease_type,
                'annual_rent_increase' => $valuationbRequest->annual_rent_increase,
                'passing_rent' => $valuationbRequest->passing_rent,
                'market_rent' => $valuationbRequest->market_rent,
                'other_income_sources' => $valuationbRequest->other_income_sources,
                'other_income_amount' => $valuationbRequest->other_income_amount,
                'land_value' => $valuationbRequest->land_value,
                'value_per_ha' => $valuationbRequest->value_per_ha,
                'improvement_value' => $valuationbRequest->improvement_value,
                'value_per_m2' => $valuationbRequest->value_per_m2,
                'property_value' => $valuationbRequest->property_value,
                'reserve_price' => $valuationbRequest->reserve_price,
                'cap_rate' => $valuationbRequest->cap_rate,
                'yield_rate' => $valuationbRequest->yield_rate,
                'discount_rate' => $valuationbRequest->discount_rate,
                'vacancy_rates' => $valuationbRequest->vacancy_rates,
                'irr' => $valuationbRequest->irr,
                'operating_cost_ration' => $valuationbRequest->operating_cost_ration,
                'purpose_of_valution' => $valuationbRequest->purpose_of_valution,
                'date_of_inspection' => $valuationbRequest->date_of_inspection,
                'date_of_valuation' => $valuationbRequest->date_of_valuation,
                'primary_valuation_method' => $valuationbRequest->primary_valuation_method,
                'secondary_valuation_method' => $valuationbRequest->secondary_valuation_method,
                'means_of_property_acquisition' => $valuationbRequest->means_of_property_acquisition,
            ]);

            return response(['success' => true, 'property_id' => $property->id], 201);
        }
    }

    public function uploadImages(Request $request, $id) {
        $property = Property::find($id);

        if($request->file('Front_view')) {
            $property->addMediaFromRequest('Front_view')->toMediaCollection('front_views');
        }

        if($request->file('Back_view')) {
            $property->addMediaFromRequest('Back_view')->toMediaCollection('back_views');
        }

        if($request->file('Inside_view')) {
            $property->addMediaFromRequest('Inside_view')->toMediaCollection('inside_views');
        }

        if($request->file('Floor_Plan_1')) {
            $property->addMediaFromRequest('Floor_Plan_1')->toMediaCollection('floor_plan_1_views');
        }

        if($request->file('Floor_Plan_2')) {
            $property->addMediaFromRequest('Floor_Plan_2')->toMediaCollection('floor_plan_2_views');
        }

        if($request->file('Floor_Plan_3')) {
            $property->addMediaFromRequest('Floor_Plan_3')->toMediaCollection('floor_plan_3_views');
        }

        return response(['success' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::find($id);

        return new PropertyResource($property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
