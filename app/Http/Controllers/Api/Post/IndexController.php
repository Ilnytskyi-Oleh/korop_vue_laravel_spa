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
        if (!in_array($sortField, ['title', 'text', 'created_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = request('sort_direction', 'desc');
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $filled = array_filter(request()->only([
            'title',
            'text',
            'created_at'
        ]));

        $posts = Post::when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(request('search', '') != '', function ($query) {
            $query->where(function ($q) {
                $q->where('title', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('text', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('created_at', 'LIKE', '%' . request('search') . '%');
            });
        })->when(request('category_id', '') != '', function ($query) {
            $query->where('category_id', request('category_id'));
        })->orderBy($sortField, $sortDirection)->paginate(3);

        return PostResource::collection($posts);
    }
}
