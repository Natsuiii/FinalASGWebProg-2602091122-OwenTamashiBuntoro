<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::all();
        $userHobbies = Auth::user()->hobbies->pluck('id')->toArray(); // ID hobi user
        return view('home.settings', compact('hobbies', 'userHobbies'));
    }

    public function setAccountVisible(Request $request)
    {
        $user = User::find(Auth::id());
        $currentVisibility = $user->account_visible;

        if (!$request->has('visibility') && $currentVisibility === 1) {
            return back()->with('error', 'Account is already visible.');
        }

        if ($request->has('visibility') && $currentVisibility === 0) {
            return back()->with('error', 'Account is already invisible.');
        }

        if ($request->has('visibility')) {
            if ($user->coins < 50) {
                return back()->with('error', 'Not enough coins to make account invisible.');
            }

            $user->account_visible = 0;
            $user->coins -= 50;

            $bearImages = ['bear/bear-1.jpeg', 'bear/bear-2.jpeg', 'bear/bear-3.jpeg']; // Gambar relatif
            $randomBear = $bearImages[array_rand($bearImages)];
            $user->bear_image = $randomBear;

            $user->save();

            return back()->with('success', 'Account visibility set to invisible. 50 coins deducted.');
        }

        if (!$request->has('visibility')) {
            if ($user->coins < 5) {
                return back()->with('error', 'Not enough coins to make account visible.');
            }

            if ($user->bear_image) {
            }

            $user->account_visible = 1;
            $user->coins -= 5;

            $user->save();

            return back()->with('success', 'Account visibility set to visible. 5 coins deducted.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Password updated successfully. Please log in again.');
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:50',
            'hobby' => 'required|array|min:3',
            'phone' => [
                'required',
                'numeric',
            ],
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        // Update data user
        $user->name = $request->name;
        $user->description = $request->description;
        $user->instagram = $request->instagram;
        $user->phone_number = $request->phone;
        $user->email = $request->email;
        $user->hobbies()->sync($request->hobby);

        // Upload dan simpan gambar profil jika ada
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $file;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
