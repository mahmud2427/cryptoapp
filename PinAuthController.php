<?php
 
public function register(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'pin' => 'required|digits:8|confirmed', // use confirmed if you want a pin confirmation field
        // 'password' => 'required|string|min:8|confirmed', // only if you're using a password field too
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'pin' => $request->pin,
        'password' => bcrypt($request->pin), // or use actual password if you're using one
    ]);

    Auth::login($user);
    return redirect()->route('dashboard');
}
    
    
    
