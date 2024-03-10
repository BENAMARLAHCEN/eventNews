<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\updateRoleRequest;
use App\Models\Permission;
use App\Repository\Interface\IRoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $role;

    public function __construct(IRoleRepository $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        
        $roles = $this->role->list();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role = $this->role->storeOrUpdate(['name'=> $request->validated()['name']]);

        $role->givePermissionsTo($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = $this->role->findById($id);
        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function show($id)
    {
        $role = $this->role->findById($id);
        return view('admin.roles.show', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'name' => 'required|unique:roles,name,'.$id.'|max:50',
            'permissions' => ['required', 'array'],
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = $this->role->storeOrUpdate($data, $id);

        $role->refreshPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $this->role->destroyById($id);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
