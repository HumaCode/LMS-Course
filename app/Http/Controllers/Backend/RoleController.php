<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Models\GroupName;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

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
}
