<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

use App\Models\Account\User;

class RegisterController extends RegisteredUserController
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('pages/auth/register');
    }

    public function registerAccount(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // // Tidak Langsung ke halaman Login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_account' => 'inactive',
        ]);
        return redirect()->route('login')
            ->with('status', 'Registration successful! Please log in.');

        // // Langsung ke halaman Login
        // $user = tap(User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]), function (User $user) {
        //     $this->guard()->login($user);
        // });
        // return redirect()->intended('/dashboard');
    }
}
