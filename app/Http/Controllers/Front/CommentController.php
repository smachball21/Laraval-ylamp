<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Return comments
     **/
    public function showComment(Post $post)
    {
        dd($post->comments()->get());
    }
}
