<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function buyAvatar(Avatar $avatar)
    {
        $user = User::find(Auth::id());

        // Pastikan user memiliki cukup koin
        if ($user->coins < $avatar->price) {
            return back()->with('error', 'Not enough coins');
        }

        // Cek apakah user sudah memiliki avatar ini
        if ($user->avatars->contains($avatar)) {
            return back()->with('error', 'You already own this avatar');
        }

        // Tambahkan avatar ke user dan kurangi koin
        $user->avatars()->attach($avatar->id);
        $user->coins -= $avatar->price;
        $user->save();

        return back()->with('success', 'Avatar purchased successfully');
    }
}
