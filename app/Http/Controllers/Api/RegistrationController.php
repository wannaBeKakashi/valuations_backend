<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Valuer;
use App\Mail\EmailVerifyMail;

use App\Http\Resources\Valuers\ValuerResource;
use App\Http\Resources\FinancialInstitution\FinancialInstitutionResource;
use App\Models\User;
use App\Models\Client;
use App\Models\FinancialInstitution;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\FinancialInstitution\StoreFinancialInstitution;

use App\Http\Resources\Client\ClientResource;
use App\Http\Requests\Valuers\StoreRequest;




use Illuminate\Support\Facades\Hash;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Mail;


class RegistrationController extends Controller
{
    //

    public function registerValuer(StoreRequest $request) : ValuerResource
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

    public function registerClient(ClientStoreRequest $request) : ClientResource 
    {
        $fields = $request->post();

        $client = Client::create($fields); 

        //create a user account for valuer
        $user = new User();
        $user->name= $client->first_name." ".$client->last_name;
        $user->email = $request->email;
        $user->role='client';
        $user->password=Hash::make($request->password);
        $user->save();

        //update valuer user_id
        $client->user_id=$user->id;
        $client->save();

        //send email
        Mail::to($user->email)->later(now()->addSeconds(5), new AccountCreationMail($user->name, $user->email));

        // to do send success  registration email
        return new ClientResource($client);
    }
    public function registerFinancialInstitution(StoreFinancialInstitution $request) : FinancialInstitutionResource{
       
        $fields = $request->post();
        $fi = FinancialInstitution::create($fields); 

        //create a user account for valuer
        $user = new User();
        $user->name= $fi->name;
        $user->email = $request->email;
        $user->role='financial_institution';
        $user->password=Hash::make($request->password);
        $user->save();

        //update valuer user_id
        $fi->user_id=$user->id;
        $fi->save();

        //save logo
        if($request->file('logo')) {
            $fi->addMediaFromRequest('logo')->toMediaCollection('logos');
        }

        //send email
        Mail::to($user->email)->later(now()->addSeconds(5), new AccountCreationMail($user->name, $user->email));

        return new FinancialInstitutionResource($fi);
    }
    public function  generate_otp(Request $request) : JsonResponse
    {
          $request ->validate ([
              'name'=>'required|string',
              'email'=>'required|email'
          ]);

          //generate opt
          $otp = random_int(100000, 999999);

          //mail otp
        Mail::to($request->email)->later(now()->addSeconds(3),new EmailVerifyMail($request->name,$otp));


        //return otp
        return response()->json([
            'otp' =>$otp,
        ]);

    }
   
}
