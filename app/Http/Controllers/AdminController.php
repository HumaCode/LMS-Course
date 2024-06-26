<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message'       => 'Logout Successfully',
            'alert-type'    => 'info',
        ];

        return redirect('/admin/login')->with($notification);
    }

    public function adminLogin()
    {

        return view('admin.admin_login');
    }

    public function adminProfile()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;

        $attr = $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users,username,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'phone'     => 'required|unique:users,phone,' . $id,
            'address'   => 'nullable',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:1000'
        ]);

        $data = User::findOrFail($id);

        $data->name         = $attr['name'];
        $data->username     = $attr['username'];
        $data->email        = $attr['email'];
        $data->phone        = $attr['phone'];
        $data->address      = $attr['address'];


        if ($request->file('photo')) {

            // unlink foto
            if ($data->photo <> "") {
                unlink('upload/admin_images/' . $data->photo);
            }


            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);

            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message'       => 'Admin Profile Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function adminChangePassword()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    }

    public function adminPasswordUpdate(Request $request)
    {
        $attr = $request->validate([
            'old_password'                  => 'required',
            'new_password'                  => 'required|min:6|confirmed',
            'new_password_confirmation'     => 'required',
        ]);

        if (!Hash::check($attr['old_password'], auth::user()->password)) {
            $notification = [
                'message'       => 'Old Password Does Not Match..!',
                'alert-type'    => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($attr['new_password']),
        ]);

        $notification = [
            'message'       => 'Password Change Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function becomeInstructor()
    {
        return view('frontend.instructor.reg_instructor');
    }

    public function instructorRegister(Request $request)
    {
        $attr = $request->validate([
            'name'                  => 'required|unique:users,name',
            'username'              => 'required|unique:users,username',
            'email'                 => 'required|unique:users,email',
            'phone'                 => 'required|unique:users,phone',
            'address'               => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);


        User::insert([
            'name'          => $attr['name'],
            'username'      => $attr['username'],
            'email'         => $attr['email'],
            'phone'         => $attr['phone'],
            'address'       => $attr['address'],
            'password'      => Hash::make($attr['password']),
            'role'          => 'instructor',
            'status'        => '0',
        ]);

        $notification = [
            'message'       => 'Instructor Register Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('instructor.login')->with($notification);
    }

    public function allInstructor()
    {
        $title      = 'All Instructor';
        $subtitle   = 'all instructor';
        $allInstructor = User::where('role', 'instructor')->latest()->get();

        return view('admin.backend.instructor.all_instructor', compact('title', 'subtitle', 'allInstructor'));
    }

    public function updateUserStauts(Request $request)
    {
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);

        $user = User::find($userId);
        if ($user) {
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully']);
    }

    public function adminAllCourses()
    {
        $title      = 'All Courses';
        $subtitle   = 'all courses';
        $courses    = Course::with('user', 'category')->latest()->get();

        return view('admin.backend.courses.all_courses', compact('courses', 'title', 'subtitle'));
    }

    public function updateCourseStauts(Request $request)
    {
        $courseId   = $request->input('course_id');
        $isChecked  = $request->input('is_checked', 0);

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Course Status Updated Successfully']);
    }

    public function updateCourseDetail($slug)
    {
        $title      = 'Course Details';
        $subtitle   = 'course details';
        $course     = Course::where('course_name_slug', $slug)->first();

        return view('admin.backend.courses.detail_course', compact('title', 'subtitle', 'course'));
    }

    /////// manage admin  /////////////////////

    public function adminAllAdmin()
    {
        $title      = 'All Admin';
        $subtitle   = 'all admin';
        $alladmin   = User::where('role', 'admin')->get();

        return view('admin.backend.pages.admin.all_admin', compact('title', 'subtitle', 'alladmin'));
    }

    public function adminAddAdmin()
    {
        $title      = 'Add Admin';
        $subtitle   = 'add admin';
        $roles      = Role::all();

        return view('admin.backend.pages.admin.add_admin', compact('title', 'subtitle', 'roles'));
    }

    public function adminStoreAdmin(Request $request)
    {
        $attr = $request->validate([
            'name'           => 'required',
            'username'       => 'required',
            'email'          => 'required|unique:users,email',
            'phone'          => 'required',
            'address'        => 'required',
            'password'       => 'required|min:6',
            'role'           => 'required|exists:roles,name',
        ]);

        $user = new User();
        $user->name             = $attr['name'];
        $user->username         = $attr['username'];
        $user->email            = $attr['email'];
        $user->phone            = $attr['phone'];
        $user->address          = $attr['address'];
        $user->password         = Hash::make($attr['password']);
        $user->role             = 'admin';
        $user->status           = '1';
        $user->save();

        if ($attr['role']) {
            $user->assignRole($attr['role']);
        }

        $notification = [
            'message'       => 'New Admin Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.admin')->with($notification);
    }

    public function adminEditAdmin($id)
    {
        $title      = 'Edit Admin';
        $subtitle   = 'edit admin';
        $roles      = Role::all();
        $user       = User::findOrFail($id);

        return view('admin.backend.pages.admin.edit_admin', compact('title', 'subtitle', 'roles', 'user'));
    }

    public function adminUpdateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $attr = $request->validate([
            'name'           => 'required',
            'username'       => 'required',
            'email'          => 'required|unique:users,email,' . $id,
            'phone'          => 'required',
            'address'        => 'required',
            'role'           => 'required|exists:roles,name',
        ]);

        $user->name             = $attr['name'];
        $user->username         = $attr['username'];
        $user->email            = $attr['email'];
        $user->phone            = $attr['phone'];
        $user->address          = $attr['address'];
        $user->role             = 'admin';
        $user->status           = '1';
        $user->save();

        $user->roles()->detach();

        if ($attr['role']) {
            $user->assignRole($attr['role']);
        }

        $notification = [
            'message'       => 'Admin Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.admin')->with($notification);
    }

    public function adminDeleteAdmin($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = [
            'message'       => 'Admin Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
