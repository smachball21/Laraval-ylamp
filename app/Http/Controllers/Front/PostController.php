<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function get()
    {
        $posts = Auth::user()->posts;

        return view('front.posts', compact('posts'));

    }
}
