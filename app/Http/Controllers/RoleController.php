<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    // role list
    public function index()
    {
        try {
            $roles = Role::all();
            return view('admin.role.index', [
                'roles' => $roles,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // role create
    public function create()
    {
        try {
            return view('admin.role.create');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // role store
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required',
            ]);

            $role = new Role();
            $role->name = $request->name;
            $role->save();

            $notification = array(
                'message'       => 'Role Created',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // role edit
    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);

            return view('admin.role.edit', [
                'role'        => $role,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // role update
    public function update(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required',
            ]);

            $role = Role::findOrFail($request->id);

            $role->name = $request->name;
            $role->update();

            $notification = array(
                'message'       => 'Role Updated',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // role delete
    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);

            $role->delete();

            $notification = array(
                'message'   => 'Role Deleted',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission under role
    public function rolePermission()
    {
        try {
            $roles = Role::all();

            return view('admin.role.rolePermission', [
                'roles'     => $roles,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // edit permission under role
    public function editRolePermission($id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();

            return view('admin.role.editRolePermission', [
                'role'          => $role,
                'permissions'   => $permissions,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // update permission under role
    public function rolePermissionUpdate(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $permission = $request->permission_id;

            if (!empty($permission)) {
                $role->syncPermissions($permission);
            }

            $notification = array(
                'message'       => 'Role Permisison Updated',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // delete role permission
    public function deleteRolePermission($id)
    {
        try {
            $role = Role::findOrFail($id);

            if (!is_null($role)) {
                $role->delete();
            }

            $notification = array(
                'message' => 'Role Permission Deleted',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
