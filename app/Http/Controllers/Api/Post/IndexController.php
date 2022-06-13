<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;


class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::when(request('category_id', '') != '', function ($query){
            $query->where('category_id', request('category_id'));
        })->paginate(3);
        return PostResource::collection($posts);
    }
}
