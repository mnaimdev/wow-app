<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    // permission list
    public function index()
    {
        try {
            $permissions = Permission::all();
            return view('admin.permission.index', [
                'permissions' => $permissions,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission create
    public function create()
    {
        try {
            return view('admin.permission.create');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission store
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required',
            ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->save();

            $notification = array(
                'message'       => 'Permission Created',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission edit
    public function edit($id)
    {
        try {
            $permission = Permission::findOrFail($id);

            return view('admin.permission.edit', [
                'permission'        => $permission,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission update
    public function update(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required',
            ]);

            $permission = Permission::findOrFail($request->id);
            $permission->name = $request->name;
            $permission->update();

            $notification = array(
                'message'       => 'Permission Updated',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // permission delete
    public function delete($id)
    {
        try {
            $permission = Permission::findOrFail($id);

            $permission->delete();

            $notification = array(
                'message'   => 'Permission Deleted',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // add role in permission
    function addRolePermission()
    {
        try {
            $roles = Role::all();
            $permissions = Permission::all();

            return view('admin.permission.addRolePermission', [
                'roles'             => $roles,
                'permissions'       => $permissions,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // store permission under role
    public function rolePermissionStore(Request $request)
    {

        try {
            $request->validate([
                'role_id'        => 'required',
                'permission_id'  => 'required',
            ]);

            $data = array();

            $permissions = $request->permission_id;

            foreach ($permissions as $permission) {
                $data['role_id'] = $request->role_id;
                $data['permission_id'] = $permission;

                DB::table('role_has_permissions')->insert($data);
            }

            $notification = array(
                'message'       => 'Role Permission Added',
                'alert-type'    => 'success',
            );

            return back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
