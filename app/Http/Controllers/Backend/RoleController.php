<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\GroupName;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private function capitalizeName($name)
    {
        // Pisahkan nama menjadi array kata
        $words = explode(" ", $name);
        $capitalizedName = "";

        // Loop melalui setiap kata
        foreach ($words as $word) {
            // Konversi huruf pertama ke huruf kapital dan sisanya ke huruf kecil
            $capitalizedWord = ucfirst(strtolower($word));
            $capitalizedName .= $capitalizedWord . " ";
        }

        // Hapus spasi ekstra yang mungkin terjadi di akhir
        $capitalizedName = rtrim($capitalizedName);

        return $capitalizedName;
    }

    public function adminGroupName()
    {
        $title      = 'All Group Name';
        $subtitle   = 'all group name';
        $groupName  = GroupName::latest()->get();

        return view('admin.backend.pages.permission.group_name', compact('title', 'subtitle', 'groupName'));
    }

    public function adminStoreGroupName(Request $request)
    {
        $attr = $request->validate([
            'g_name'      => 'required',
        ]);

        $groupName = $this->capitalizeName($attr['g_name']);

        GroupName::insert([
            'g_name'        => $groupName,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Group Name Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.group.name')->with($notification);
    }

    public function adminUpdateGroupName(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'g_name'            => 'required|unique:group_names,g_name,' . $id,
        ]);

        $groupName = $this->capitalizeName($attr['g_name']);


        GroupName::find($id)->update([
            'g_name'        => $groupName,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Group Name Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.group.name')->with($notification);
    }

    public function adminGroupNameEdit($id)
    {
        $group_name = GroupName::findOrFail($id);

        return response()->json($group_name);
    }

    public function adminDeleteGroupName($id)
    {
        GroupName::findOrFail($id)->delete();

        $notification = [
            'message'       => 'Group Name Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function adminAllPermission()
    {
        $title          = 'All Permission';
        $subtitle       = 'all permission';
        $permissions    = Permission::all();

        return view('admin.backend.pages.permission.all_permission', compact('permissions', 'title', 'subtitle'));
    }

    public function adminAddPermission()
    {
        $title          = 'Add Permission';
        $subtitle       = 'add permission';
        $group_name     = GroupName::all();

        return view('admin.backend.pages.permission.add_permission', compact('group_name', 'title', 'subtitle'));
    }

    public function adminStorePermission(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required',
            'group_name'    => 'required|exists:group_names,g_name',
        ]);

        Permission::create([
            'name'        => $attr['name'],
            'group_name'  => $attr['group_name'],
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Permission Created Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function adminEditPermission($id)
    {
        $title          = 'Edit Permission';
        $subtitle       = 'edit permission';
        $permission     = Permission::findOrFail($id);
        $group_name     = GroupName::all();


        return view('admin.backend.pages.permission.edit_permission', compact('permission', 'group_name', 'title', 'subtitle'));
    }

    public function adminUpdatePermission(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'name'          => 'required',
            'group_name'    => 'required|exists:group_names,g_name',
        ]);

        Permission::findById($id)->update([
            'name'        => $attr['name'],
            'group_name'  => $attr['group_name'],
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Permission Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function adminDeletePermission($id)
    {
        $data = Permission::find($id);
        $data->delete();

        $notification = [
            'message'       => 'Permission Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }



    // import & export

    public function adminImportPermission()
    {
        $title          = 'Import Permission';
        $subtitle       = 'import permission';


        return view('admin.backend.pages.permission.import_permission', compact('title', 'subtitle'));
    }

    public function adminExportPermission()
    {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }

    public function adminUploadPermission(Request $request)
    {
        $attr = $request->validate([
            'import_file' => 'required|mimes:xlsx|max:1024',
        ]);

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = [
            'message'       => 'Category Imported Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }




    //  All Roles 

    public function adminAllRoles()
    {
        $title      = 'All Roles';
        $subtitle   = 'all roles';
        $roles      = Role::latest()->get();

        return view('admin.backend.pages.roles.all_roles', compact('roles', 'title', 'subtitle'));
    }

    public function adminAddRoles()
    {
        $title      = 'Add Roles';
        $subtitle   = 'add roles';
        $roles      = Role::latest()->get();

        return view('admin.backend.pages.roles.add_roles', compact('roles', 'title', 'subtitle'));
    }

    public function adminStoreRoles(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required',
        ]);

        $name = $this->capitalizeName($attr['name']);

        Role::create([
            'name'        => $name,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Roles Created Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function adminEditRoles($id)
    {
        $title      = 'Edit Roles';
        $subtitle   = 'edit roles';
        $role       = Role::findOrFail($id);

        return view('admin.backend.pages.roles.edit_roles', compact('role', 'title', 'subtitle'));
    }

    public function adminUpdateRoles(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $name = $this->capitalizeName($attr['name']);

        Role::findById($id)->update([
            'name'        => $name,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Roles Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function adminDeleteRoles($id)
    {
        $data = Role::find($id);
        $data->delete();

        $notification = [
            'message'       => 'Roles Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    //////////////////////// -------- Roles In Permission ///////////////////////////////

    public function adminAddRolesPermission()
    {
        $title              = 'Role In Permission';
        $subtitle           = 'role in permission';
        $roles              = Role::all();
        $group_permissions  = User::getpermissionGroups();

        return view('admin.backend.pages.rolesetup.add_roles_permission', compact('roles', 'group_permissions', 'title', 'subtitle'));
    }
}
