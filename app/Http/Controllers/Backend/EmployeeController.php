<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Rules\UsernameRule;
use App\Rules\MobileRule;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function AllEmployee()
    {
        $rolesToExclude = Role::where('name', 'SuperAdmin')->pluck('id')->toArray();
        $allemployee = User::where('role', 'employee')-> whereHas(
            'roles', function ($query) use ($rolesToExclude)
            { $query->whereNotIn('role_id', $rolesToExclude); }
        )->get();

        return view('backend.employee.all_employee', compact('allemployee'));
    }

    public function AddEmployee()
    {
        $roles = Role::all();
        return view('backend.employee.add_employee',compact('roles'));
    }// End Mehtod

    public function StoreEmployee(Request $request)
    {
        $validator = validator(request()->all(), [
            'username' => ['required', new UsernameRule, 'unique:users,username'],
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', new MobileRule, 'unique:users,phone'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->aboutme = $request->aboutme;
        $user->password = Hash::make($request->password);
        $user->role = 'employee';
        $user->status = 'active';

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/admin_images/' . $name_gen;
            Image::make($image)->resize(300, 400)->save(public_path($imagePath));
            $imageName = $name_gen;
            $user['photo'] = $imageName;
        }

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Employee Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod
}
