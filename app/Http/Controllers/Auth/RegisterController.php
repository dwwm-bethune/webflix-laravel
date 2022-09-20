<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => str($request->email)->before('@'),
            'email' => $request->email,
            // Hash::make($request->password);
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/films');
    }
}
