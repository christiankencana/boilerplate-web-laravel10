<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('permissions.index');

        $permissions = Permission::when($request->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->latest()->get();

        return view('pages/account/permission/index', [
            'permissions' => $permissions
        ]);
    }
}
