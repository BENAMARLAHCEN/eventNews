<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\Request;
use App\Models\Permission;

class UserController extends Controller
{
    protected $user;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->list();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = $this->user->findById($id);
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'permissions'));
    }

    // As an administrator, I want to be able to manage users by restricting their access.

    public function restrictAccess($id, Request $request)
    {
        $user = $this->user->findById($id);

        if ($user) {
            if ($request->permissions == null) {
                $user->blockedPermissions()->detach();
            } else {
                $user->refreshBlokedPermissions($request->permissions);
            }
            return redirect()->back()->with('success', 'User access restricted successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}
