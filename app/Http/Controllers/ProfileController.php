<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;

use App\Models\Account\User;
use App\Models\Operation\Company;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = Role::all();
        $companies = Company::all();
        return view('pages/profile', compact('user', 'roles', 'companies'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|max:30',
            'email'    => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        if ($request->file('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            $filename = 'profile_photos/' . $user->id . '-' . $user->name . '.' . $request->file('profile_photo')->extension();
            $photoPath = $request->file('profile_photo')->storeAs('public', $filename);
            $user->update(['profile_photo' => $filename]);
        }

        $user->syncRoles($request->roles);

        $user->companies()->sync($request->companies);

        return redirect()->route('profiles.index')
            ->with('success', 'Profile updated successfully.');
    }
}
