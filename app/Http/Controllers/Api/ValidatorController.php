<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\StrongPassword;

class ValidatorController extends Controller
{
    //
    public function validate_valuer_registration(Request $request){

        $page = $request->page_number;


        //valuer registration validation
        if($page == 'page1'){

            $request->validate([
                'first_name' =>['required','string'],
                'middle_name' =>['nullable'],
                'valuer_number' =>['required', Rule::unique('valuers','valuer_number')],
                'affiliation' =>['string','nullable'],
                'last_name' =>['required','string'],
                'gender' => ['required','string', Rule::in(['male','female'])]
            ]);
        }
        elseif ($page =="page2"){
            $request->validate([
                'phone' =>['required','string',Rule::unique('valuers','phone'), Rule::unique('clients','phone')],
                'email' =>['email','required',Rule::unique('users','email')],
                'physical_address' =>['required'],

            ]);
        }
        elseif ($page =="page4"){

            $request->validate([
                'password' => ["required", "string"],
                'password_confirmation' => ["required", "string", "same:password"],
            ]);
        }

        //fi registration
        elseif ($page =="fi_page1"){
            $request->validate([
                'name' =>['required','string'],
                'institution_type' =>['required','string'],

            ]);
        }
        elseif ($page =="fi_page2"){
            $request->validate([
                'phone' =>['required','string',Rule::unique('valuers','phone'), Rule::unique('clients','phone')],
                'email' =>['email','required',Rule::unique('users','email')],
                'physical_address' =>['required'],

            ]);
        }


        //clients registration validation
        else if($page == 'c_page1'){
            $request->validate([
                'first_name' =>['required','string'],
                'middle_name' =>['nullable'],
                'last_name' =>['required','string'],
                'gender' => ['required','string', Rule::in(['male','female'])]
            ]);
        }
        elseif ($page =="c_page2"){
            $request->validate([
                'phone' =>['required','string',Rule::unique('clients','phone'),Rule::unique('valuers','phone')],
                'email' =>['email','required',Rule::unique('users','email')],
                'physical_address' =>['required'],

            ]);
        }


        elseif($page == 'location'){
            $request->validate([
                'region' =>['required','string',Rule::in(['North','South','East','Central'])],
                'district' =>['required','string'],
                'area' =>['required','string'],
                'google_map_link' =>['required','string'],
                'latitude' =>['required','numeric'],
                'longitude' =>['required','numeric'],
                'zone_category' =>['required','string'],
                'zoning' =>['required', 'string']
            ]);
        }
        elseif($page == 'site'){
            $request->validate([
                  'land_size' => ['required','numeric'],
//                  'land_size_unit' => ['required','string'],
                  'land_height' =>['required','numeric'],
                  'land_width' => ['required','numeric'],
                  'land_shape' =>['required'],
                  'topography' => ['required'],
                  'access' =>['required'],
                  'view' => ['required'],
                  'security' =>['required'],
                  'utilities' =>['required'],
                  'onsite_improvements' =>['required'],
                  'offsite_improvements' =>['required'],

            ]);
        }
        elseif($page == 'property'){
            $request->validate([
                'owner_name' =>['required','string'],
                'property_type' =>['required', 'string'],
                'property_design' =>['required','string'],
                'construction_stage' =>['required','string'],
                'year_built' =>['required', 'numeric'],
                'age' =>['required', 'numeric'],
                'eul' =>['required', 'string'],
                'rel' =>['required', 'string'],
                'measurements' =>['required','string'],
                'no_rooms' =>['required','numeric'],
                'no_of_bathrooms' =>['nullable','numeric'],
                'occupancy' =>['required','string'],
                'attributes' =>['required'],
                'title_deeds_available' =>['required','string', Rule::in(['yes','no'])],
                'certificate_of_search_available' =>['required','string', Rule::in(['yes','no'])],
                'encumbrances_available' =>['required','string', Rule::in(['yes','no'])],
                'defects' =>['nullable','string']

            ]);
        }

        elseif($page == 'valuationa'){

            $fields = $request->validate([
                'as_vacant' =>['required','string'],
                'as_improved' =>['required','string'],
                'legally_permissible' =>['required','string', Rule::in(['yes','no'])],
                'legally_permissible_exp' =>['required','string'],
                'physically_feasible' =>['required','string'],
                'physically_feasible_exp' =>['required','string'],
                'financially_feasible' =>['required','string'],
                'financially_feasible_exp' =>['required','string'],
                'hbu_general_comments' =>['required','string'],
                'foundation' =>['required'],
                'floor' =>['required'],
                'external_walls' =>['required'],
                'internal_walls' =>['required'],
                'windows' =>['required'],
                'doors' =>['required'],
                'ceiling' =>['required'],
                'roof' =>['required'],
                'physical_deterioration' =>['required','numeric'],
                'functional_obsolesce' =>['required','numeric'],
                'external_obsolesce' =>['required','numeric'],
                'externalities' =>['required','string']

            ]);
        }

        elseif($page == 'valuationb') {
            $request->validate([
                'lease_type' =>['required'],
                'annual_rent_increase' =>['required'],
                'passing_rent' =>['required'],
                'market_rent' =>['required'],
                'other_income_sources'=>['required'],
                'other_income_amount' =>['required'],
                'land_value' =>['required'],
                'value_per_ha' =>['required'],
                'improvement_value' =>['required'],
                'value_per_m2' =>['required'],
                'property_value' =>['required'],
                'reserve_price' =>['required'],
                'cap_rate' =>['required'],
                'yield_rate' =>['required'],
                'discount_rate' =>['required'],
                'vacancy_rates' =>['required'],
                'irr' =>['required'],
                'operating_cost_ration' =>['required'],
                'purpose_of_valution' =>['required'],
                'date_of_inspection' =>['required'],
                'date_of_valuation' =>['required'],
                'primary_valuation_method' =>['required'],
                'secondary_valuation_method' =>['required'],
                'means_of_property_acquisition' =>['required']
            ]);
        }

        //posts create
        else if($page == 'posts_create'){
            $request->validate([
                 'title' => ['required','string'],
                 'description' =>['required','string'],
            ]);
        }

        //comps search 
        else if($page == 'comps_search') {
            $request->validate([
                 'latitude' =>['required','numeric'],
                 'longitude' =>['required', 'numeric']
            ]);
        }
    }
}
