<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Valuer;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    //
    public function admin_index() : JsonResponse 
    {
        $users = count(User::all());
        $valuers = count(Valuer::all());
        $properties = count(Property::all());

        return response()->json([
            'users' =>$users,
            'valuers' =>$valuers,
            'properties' =>$properties,
            'counts' => $this->get_user_type_counts(),
            'upload_trends' => $this->get_uploads_trends()
        ]);
    }
    private function get_user_type_counts(){

         $roles = ['admin','valuer','client','financial_institution','valuer_intern'];
         $counts =[];

         foreach($roles as $role){
             $counts[$role] = User::where('role',$role)->count();
         }

         return $counts;
    }
    private function get_uploads_trends(){

        return  Property::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))->groupBy('date')->orderBy('date','ASC')->get();
    }

    
}
