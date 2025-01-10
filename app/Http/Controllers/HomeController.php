<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $friendSuggestions = $user->getNonFriends();
        $hobbies = Hobby::all();
        return view('home.index', compact('friendSuggestions', 'hobbies'));
    }

    public function profile()
    {
        $user = Auth::user();
        $friends = $user->friends()
            ->wherePivot('status', 'accepted')
            ->get()
            ->merge(
                $user->friendRequests()
                    ->wherePivot('status', 'accepted')
                    ->get()
            );
        $requests = Auth::user()->friendRequests->where('pivot.status', 'pending');
        return view('home.profile', compact('friends', 'requests'));
    }

    public function topup()
    {
        return view('home.topup');
    }

    public function detail(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('home.profile');
        }
        $isFriend = Auth::user()->friends()->where('friend_id', $user->id)->orWhere('user_id', $user->id)->exists();
        $friends = $user->friends()
            ->wherePivot('status', 'accepted')
            ->get()
            ->merge(
                $user->friendRequests()
                    ->wherePivot('status', 'accepted')
                    ->get()
            );
        return view('home.detail', compact('user', 'isFriend', 'friends'));
    }

    public function avatar()
    {
        $user = User::find(Auth::id());

        $ownedAvatarIds = $user->avatars()->pluck('avatar_id')->toArray();

        $avatars = Avatar::whereNotIn('id', $ownedAvatarIds)->paginate(5);

        return view('home.avatar', compact('avatars'));
    }
}
