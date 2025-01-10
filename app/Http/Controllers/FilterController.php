<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $friendSuggestions = $user->getNonFriends();

        $hobbies = Hobby::all();
        return view('home.search', compact('hobbies', 'friendSuggestions'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        // Ambil query dasar dari getNonFriends
        $query = $user->getNonFriendsQuery();

        // Tambahkan filter untuk nama
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Tambahkan filter untuk gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Tambahkan filter untuk hobi
        if ($request->filled('hobby')) {
            $query->whereHas('hobbies', function ($hobbyQuery) use ($request) {
                $hobbyQuery->whereIn('id', $request->hobby);
            });
        }

        // Ambil hasil paginasi
        $friendSuggestions = $query->paginate(10);

        $hobbies = Hobby::all();

        return view('home.search', compact('friendSuggestions', 'hobbies'));
    }
}
