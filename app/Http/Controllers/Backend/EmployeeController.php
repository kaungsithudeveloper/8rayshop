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
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
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

        return redirect()->route('all.employee')->with($notification);

    }// End Mehtod

    public function EditEmployee($id)
    {

        $employeeData = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return view('backend.employee.edit_employee',compact('employeeData','roles'));
    }// End Mehtod

    public function UpdateEmployee(Request $request, $id)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
                'phone' => ['required', 'string', 'max:15', 'unique:users,phone,' . $id],
                'aboutme' => ['nullable', 'string', 'max:1000'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = User::findOrFail($id);

            // Update user data
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->aboutme = $request->aboutme;
            $user->role = 'employee'; // You may update this as needed
            $user->status = 'active'; // You may update this as needed

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/admin_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $user->photo = $imageName;

                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete('upload/admin_images/' . $user->photo);
                }
            }

            $user->save();

            // Update user roles
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            $notification = [
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.employee')->with($notification);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            $notification = [
                'message' => 'An error occurred while updating the user.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }// End Mehtod

    public function DeleteEmployee($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod

    public function EmployeeDashboard()
    {
        return view('backend.employee.dashboard');
    }
}
