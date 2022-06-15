<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;


class DeleteController extends Controller
{
    public function __invoke( Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}