<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Posts\StoreRequest;
use App\Http\Resources\Posts\PostResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostsController extends Controller
{
    //
    public function index () :   AnonymousResourceCollection
    {
        $posts  = Post::orderby('created_at','desc')->get();

        return PostResource::collection($posts);
    }
    public function store(StoreRequest $request)  : PostResource 
    {
        $fields = $request->post();

        $post = Post::create($fields);

        //save media
         //save logo
         if($request->file('media')) {
            $post->addMediaFromRequest('media')->toMediaCollection('medias');
        }

        return new PostResource($post);
    }
}
