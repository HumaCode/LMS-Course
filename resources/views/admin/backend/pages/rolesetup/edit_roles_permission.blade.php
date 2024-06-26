@extends('admin.admin_dashboard')

@push('css')
    <style>
        .form-check-label {
            text-transform: capitalize;
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-plus"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.all.roles.permission') }}" class="btn btn-danger tbl-custom"><i
                            class="bx bx-left-arrow-alt"></i>Back</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="row">
            <div class="col-xl-12 mx-auto">

                <div class="card">
                    <div class="card-body p-4">

                        <form method="POST" action="{{ route('admin.update.roles.permission', $role->id) }}"
                            class="row g-3">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id" class="form-label">Roles Name </label>

                                        <h4 class="alert alert-danger">{{ $role->name }}</h4>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckMain">
                                        <label class="form-check-label" for="flexCheckMain">
                                            Permission All
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <hr>


                            @foreach ($group_permissions as $group)
                                @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                @endphp

                                <div class="col-md-3">
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckCheckedSuccess"
                                            {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckCheckedSuccess">
                                            {{ $group->group_name }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-9">



                                    @foreach ($permissions as $permission)
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                                name="permission[]" id="checkDefault{{ $permission->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach



                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Udapte Permission</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('#flexCheckMain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        })
    </script>
@endpush
