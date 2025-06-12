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
        $roles = Role::whereIn('name', ['User Vendor', 'User Customer'])->get();
        $companies = Company::all();

        return view('pages/auth/register', compact('roles', 'companies'));
    }

    public function registerAccount(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'exists:roles,id'],
            'companies' => ['required', 'exists:tb_companies,id'],
        ]);

        $selectedRole = Role::find($request->roles);
        if (!$selectedRole || !in_array($selectedRole->name, ['User Vendor', 'User Customer'])) {
            return redirect()->back()->withErrors(['roles' => 'Invalid role selected.'])->withInput();
        }

        // // Tidak Langsung ke halaman Login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_account' => 'active',
        ]);
        $user->assignRole($selectedRole);
        $user->companies()->sync([$request->companies]);
        return redirect()->route('login')->with('status', 'Registration successful! Please log in.');

        // // Langsung ke halaman Login
        // $user = tap(User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]), function (User $user) {
        //     $this->guard()->login($user);
        // });
        // $user->assignRole($selectedRole);
        // $user->companies()->sync($request->companies);
        // return redirect()->intended('/dashboard');
    }
}
