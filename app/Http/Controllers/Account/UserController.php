<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Account\User;
use App\Models\Operation\Company;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('users.index');

        $authUserId = auth()->id();

        $users = User::when(request()->q, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->q . '%');
        })->where('id', '!=', $authUserId)->with('roles')->latest()->get();

        $roles = Role::all();
        $companies = Company::all();

        return view('pages/account/user/index', [
            'users' => $users,
            'roles' => $roles,
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        $this->authorize('users.create');

        $roles = Role::all();
        $companies = Company::all();

        return view('pages/account/user/create', [
            'roles' => $roles,
            'companies' => $companies,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('users.create');

        $request->validate([
            'name'     => 'required|max:30',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'profile_photo' => 'nullable|image|max:2048',
            'status_account' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'status_account' => $request->status_account,
        ]);

        if ($request->file('profile_photo')) {
            $filename = 'profile_photos/' . $user->id . '-' . $user->name . '.' . $request->file('profile_photo')->extension();
            $photoPath = $request->file('profile_photo')->storeAs('public', $filename);
            $user->update(['profile_photo' => $filename]);
        }

        $user->assignRole($request->roles);
        $user->companies()->sync($request->companies);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $this->authorize('users.edit');

        $user = User::with('roles', 'companies')->findOrFail($id);

        $roles = Role::all();
        $companies = Company::all();

        return view('pages/account/user/edit', [
            'user' => $user,
            'roles' => $roles,
            'companies' => $companies,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('users.edit');

        $request->validate([
            'name'     => 'required|max:30',
            'email'    => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'profile_photo' => 'nullable|image|max:2048',
            'status_account' => 'required|in:active,inactive',
        ]);

        $userData = [
            'name'          => $request->name,
            'email'         => $request->email,
            'status_account' => $request->status_account,
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

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->authorize('users.delete');

        $user = User::findOrFail($id);

        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }
        $user->delete();

        return redirect()->route('users.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $this->authorize('users.edit');

        $user = User::findOrFail($id);
        $user->status_account = $request->status_account == 'active' ? 'active' : 'inactive';
        $user->save();

        return redirect()->route('users.index');
    }

    public function updateRoles(Request $request, $id)
    {
        $this->authorize('users.edit');

        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'Roles updated successfully.');
    }

    public function updateCompanies(Request $request, $id)
    {
        $this->authorize('users.edit');

        $user = User::findOrFail($id);
        $user->companies()->sync($request->companies);

        return redirect()->route('users.index')
            ->with('success', 'Companies updated successfully.');
    }
}
