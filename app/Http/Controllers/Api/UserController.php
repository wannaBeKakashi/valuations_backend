<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        $users = User::all();

        return UserResource::collection($users);
    }
    public function store(StoreRequest $request) : UserResource
    {

          $data = $request->post();

          //make password
           $raw_pass = Str::random(5);
           $data['password'] = Hash::make($raw_pass);

           $user = User::create($data);


           //to do account create mail

        return new UserResource($user);

    }
    public function update(UpdateRequest $request, User $user): UserResource
    {
        $updates = $request->post();
        $user->update($updates);

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {

        if ($user->id == request()->user()->id) {
            return response()->json(['message' => "You can not delete your own account"], Response::HTTP_PRECONDITION_FAILED);
        }

        try {
            $user->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {

            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
