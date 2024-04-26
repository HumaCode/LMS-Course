@extends('admin.admin_dashboard')

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        tbody td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endpush

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-category-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.roles.permission') }}" class="btn btn-primary tbl-custom"><i
                            class="bx bx-plus"></i>Add Roles Permission</a>
                </div>

            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="role" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th width='10%'>Sl</th>
                                <th width='40%'>Roles Name</th>
                                <th width='50%'>Permission</th>
                                <th width='20%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->permissions as $prem)
                                            <span class="badge bg-danger">{{ $prem->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.edit.roles.permission', $item->id) }}"
                                            class="btn btn-success px-3"><i class="bx bx-edit-alt"></i>Edit</a>
                                        <a href="{{ route('admin.delete.roles', $item->id) }}" class="btn btn-danger px-3"
                                            id="delete"><i class="bx bx-trash-alt"></i>Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th width='10%'>Sl</th>
                                <th width='40%'>Roles Name</th>
                                <th width='50%'>Permission</th>
                                <th width='20%'>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#role').DataTable({
                'sort': false
            });
        });
    </script>
@endpush
