<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;


class IndexController extends Controller
{
    public function __invoke()
    {
        $sortField = request('sort_field', 'created_at');
        if(!in_array($sortField,  ['title', 'text', 'created_at'])){
            $sortField = 'created_at';
        }
        $sortDirection = request('sort_direction', 'desc');
        if(!in_array($sortDirection,  ['desc', 'asc'])){
            $sortDirection = 'desc';
        }
        $posts = Post::when(request('category_id', '') != '', function ($query){
            $query->where('category_id', request('category_id'));
        })->orderBy($sortField, $sortDirection)->paginate(3);
        return PostResource::collection($posts);
    }
}
