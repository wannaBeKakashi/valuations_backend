<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Valuers\ValuerResource;
use App\Models\Valuer;
use App\Http\Requests\Valuers\StoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Hash;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifyMail;

class ValuersController extends Controller
{
    //
    public function index() : AnonymousResourceCollection
    {

        ///select all valuers
        $valuers = Valuer::all();

        //return resource collection
        return ValuerResource::collection($valuers);
    }

    public function store(StoreRequest $request) : ValuerResource
    {
        //create a valuer
        $data = $request->post();
        $valuer = Valuer::create($data);

        //create a user account for valuer
        $user = new User();
        $user->name= $valuer->first_name." ".$valuer->last_name;
        $user->email = $request->email;
        $user->role='valuer';
        $user->password=Hash::make($request->password);
        $user->save();

        //update valuer user_id
        $valuer->user_id=$user->id;
        $valuer->save();

        //send email
        Mail::to($user->email)->later(now()->addSeconds(5), new AccountCreationMail($user->name, $user->email));

        // to do send success  registration email
        return new ValuerResource($valuer);

    }
}
