<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;


class UpdateController extends Controller
{
    public function __invoke(StoreRequest $request, Post $post)
    {
        if ($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename);
        }

        $data = $request->validated();
        $post->update($data);
        return new PostResource($post);
    }
}
