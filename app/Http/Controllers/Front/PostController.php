<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function get()
    {
        $user = Auth::user();
        $posts = Post::with('user', 'friendonlysent', 'friendonlyreceived')->orderByDesc('created_at')->paginate(25);
        return view('front.posts', compact('posts'));


    }

    public function add(Request $request)
    {
        if (!empty($request->description)) {
            $post = new Post(['description' => $request->description]);
            Auth::user()->posts()->save($post);
            return redirect()->back()->with('successNotif', "Nouveau post ajouté !");
        } else {
            return redirect()->back()->with('warningNotif', "Veuillez remplir votre post !");
        }

    }
}
