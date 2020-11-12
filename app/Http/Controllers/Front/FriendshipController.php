<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Illuminate\Support\Carbon;
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
    public function acceptFriend(Friendship $user)
    {
        $fs = Friendship::where('id', $user->id)->first();
        $fs->accepted_at = Carbon::now();
        $fs->save();

        return redirect()->back()->with('successNotif', "Demande d'ami acceptée !");
    }

    // Fonction pour refuser la demande d'ami
    public function rejectFriend(Friendship $user)
    {
        $fs = Friendship::where('id', $user->id)->first();
        $fs->rejected_at = Carbon::now();
        $fs->save();

        return redirect()->back()->with('warningNotif', "Demande d'ami refusé !");
    }

    // Fonction pour annuler la demande d'ami
    public function deletefriend(Friendship $user)
    {
        $fs = Friendship::where('id', $user->id)->first();
        $fs->canceled_At = Carbon::now();
        $fs->save();

        return redirect()->back()->with('warningNotif', "Demande d'ami annulé !");
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
            'currentuser' => $currentuser,
            'partial' => 'friends_table',
        ]);
    }

    public function friendsrequests()
    {
        $userId = Auth::user();

        $friendsrequest = Friendship::with(['sender', 'target'])
            ->where(function ($query) {
                $query->WhereNull('accepted_at')
                    ->WhereNull('rejected_at');
            })->where(function ($query2) use ($userId) {
                $query2->where('sender_id', $userId->id)
                    ->orWhere('target_id', $userId->id);
            })->get();

        return view('front.friendship', [
            'friends' => $friendsrequest,
            'currentuser' => $userId,
            'partial' => 'requests_table',
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
