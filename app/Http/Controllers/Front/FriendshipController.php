<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class FriendshipController extends Controller
{

    public function addFriend(User $user)
    {
        if ($user->id !== Auth::User()->id)
        {
            $fs = new Friendship([
                'sender_id' => Auth::User()->id,
                'target_id' => $user->id,
            ]);
            $fs->save();

            return redirect()->back()->with('successNotif', "Demande d'ami envoyée !");
        }
        else
        {
            return redirect()->back();
        }

    }

    public function list()
    {
        return view('front.friendship', [
            'users' => User::paginate(25),
        ]);
    }
}
