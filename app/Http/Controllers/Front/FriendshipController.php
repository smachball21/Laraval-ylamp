<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


class FriendshipController extends Controller
{
    // Fonction pour effectuer la demande d'ami
    public function addFriend(User $user)
    {
        if ($user->id !== Auth::User()->id) {
            $fs = new Friendship([
                'sender_id' => Auth::User()->id,
                'target_id' => $user->id,
            ]);
            $fs->save();

            return redirect()->back()->with('successNotif', "Demande d'ami envoyée !");
        } else {
            return redirect()->back();
        }

    }

    // Fonction pour accepter la demande d'ami
    public function acceptFriend(User $user)
    {
        if ($user->id !== Auth::User()->id) {
            /*$fs = new Friendship([
                'sender_id' => Auth::User()->id,
                'target_id' => $user->id,
            ]);
            $fs->save();*/

            $fs = Friendship::where('sender_id', Auth::User()->id)
                ->where('target_id', $user->id)->first();
            $fs->accepted_at = Now();

            $fs->save();

            return redirect()->back()->with('successNotif', "Demande d'ami acceptée !");
        } else {
            return redirect()->back();
        }
    }

    // Fonction pour refuser la demande d'ami
    public function rejectFriend(User $user)
    {

    }

    // Fonction pour annuler la demande d'ami
    public function deletefriend(User $user)
    {
    }

    public function myfriends(Request $request)
    {
        $currentuser = Auth::user();

        $ownfriends = Friendship::with(['target', 'sender'])
            ->WhereNotNull('accepted_at')
            ->where(function ($query) use ($currentuser) {
                $query->where('sender_id', $currentuser->id)
                    ->orWhere('target_id', $currentuser->id);
            })->get();

        return view('front.friendship', [
            'friends' => $ownfriends,
            'currentuser' => $currentuser
        ]);
    }

    public function friendsrequests()
    {
        $userId = Auth::user()->id;

        $friendsrequest = Friendship::with(['sender', 'target'])
        ->where(function ($query) {
            $query->WhereNull('accepted_at')
                ->WhereNull('rejected_at');
        })->where(function ($query2) use ($userId) {
            $query2->where('sender_id', $userId)
                ->orWhere('target_id', $userId);
        })->get();

        d($friendsrequest);

        return view('front.friendship', [
            'friends' => $friendsrequest,
        ]);
    }

    // Lister tous les utilisateurs pour les ajouter en amis ou autre
    public function list()
    {
        $userId = Auth::user()->id;

        return view('front.friendship', [
            'users' => User::paginate(25),
        ]);
    }
}
