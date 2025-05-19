<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:8',
        ]);

        $user = User::where('pin', $request->pin)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['pin' => 'Invalid PIN']);
        }
    }
}
