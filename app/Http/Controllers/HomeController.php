<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $friendSuggestions = $user->getNonFriends()->where('account_visible', 1)->take(10);
        return view('home.index', compact('friendSuggestions'));
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
}
