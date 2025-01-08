<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $hobbies = Hobby::all();
        return view('auth.register', compact('hobbies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'hobby' => 'required|array|min:3',
            'phone' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'instagram' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'amount' => 'required|numeric|min:100000',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'gender' => $request->gender,
            'instagram' => $request->instagram,
            'password' => $request->password,
        ]);

        if($request->amount >= 100000) {
            $coins = $request->amount / 1000; // Hitung coins langsung dari total amount
            $user->update(['coins' => $coins]);
        }

        $user->hobbies()->attach($request->hobby);

        Auth::login($user);

        return redirect()->route('home.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }
}
