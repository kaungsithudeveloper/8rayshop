<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;


class RoleController extends Controller
{
    public function AllPermission()
    {

        $permissions = Permission::all();
        return view('backend.permission.all_permission',compact('permissions'));

    } // End Method

    public function AddPermission()
    {
        return view('backend.permission.add_permission');
    }// End Method

    public function StorePermission(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
            'group_name' => 'required|string|max:255',
        ];

        $customMessages = [
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    }// End Method

    public function EditPermission($id)
    {

        $permission = Permission::findOrFail($id);
        return view('backend.permission.edit_permission',compact('permission'));

    }// End Method

    public function UpdatePermission(Request $request)
    {
        $per_id = $request->id;

        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
            'group_name' => 'required|string|max:255',
        ];

        $customMessages = [
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification = array(
             'message' => 'Permission Updated Successfully',
             'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    }// End Method

    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();

        $notification = array(
             'message' => 'Permission Deleted Successfully',
             'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

     ///////////////////// All Roles ////////////////////

    public function AllRoles()
    {

        $roles = Role::all();
        return view('backend.roles.all_roles',compact('roles'));

    } // End Method

    public function AddRoles()
    {
        return view('backend.roles.add_roles');
    }// End Method

    public function StoreRoles(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:roles',
        ];

        $customMessages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Role Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.roles.edit_roles',compact('roles'));
    }// End Method

    public function UpdateRoles(Request $request)
    {

        $role_id = $request->id;

        $rules = [
            'name' => 'required|string|max:255|unique:roles',
        ];

        $customMessages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Role::findOrFail($role_id)->update([
            'name' => $request->name,

        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);

    }// End Method

    public function DeleteRoles($id)
    {

     Role::findOrFail($id)->delete();
       $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

     ///////////////// Add role Permission all method ///////////////


    public function AddRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.roles.add_roles_permission',compact('roles','permissions','permission_groups'));
    }// End Method

    public function RolePermissionStore(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    }// End Method

    public function AllRolesPermission()
    {

        $roles = Role::all();
        return view('backend.roles.all_roles_permission',compact('roles'));

    } // End Method

    public function AdminRolesEdit($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.roles.edit_roles_permission',compact('role','permissions','permission_groups'));
    } // End Method

    public function AdminRolesUpdate(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }

         $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    }// End Method

    public function AdminRolesDelete($id)
    {

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

         $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

}
