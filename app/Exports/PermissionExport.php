<?php

namespace App\Exports;

use App\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ModelsPermission::select('name', 'group_name')->get();
    }
}
