<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('roles.index');

        $roles = Role::when(request()->q, function ($roles) {
            $roles = $roles->where('name', 'like', '%' . request()->q . '%');
        })->with('permissions')->latest()->get();

        return view('pages/account/role/index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $this->authorize('roles.create');

        $permissions = Permission::all();

        return view('pages/account/role/create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('roles.create');

        $request->validate([
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if (Role::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'A role with this name already exists.'])->withInput();
        }

        $role = Role::create(['name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $this->authorize('roles.edit');

        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::all();

        return view('pages/account/role/edit', [
            'role'          => $role,
            'permissions'   => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('roles.edit');

        $request->validate([
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if (Role::where('name', $request->name)->where('id', '!=', $role->id)->exists()) {
            return redirect()->back()->withErrors(['name' => 'A role with this name already exists.'])->withInput();
        }

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $this->authorize('roles.delete');

        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index');
    }
}
