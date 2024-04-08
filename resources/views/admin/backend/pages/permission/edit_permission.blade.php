@extends('admin.admin_dashboard')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
                    <a href="{{ route('admin.all.permission') }}" class="btn btn-danger tbl-custom"><i
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
                        <h5 class="mb-4">{{ $title }}</h5>

                        <form id="myForm" method="POST" action="{{ route('admin.update.permission') }}" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Permission Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Permission Name"
                                        value="{{ $permission->name }}">
                                    @error('name')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group_name" class="form-label">Group Name <span
                                            class="text-danger">*</span></label>
                                    <select name="group_name"
                                        class="form-select select2-hidden-accessible @error('group_name') is-invalid @enderror"
                                        id="single-select-field" data-placeholder="Choose one thing"
                                        data-select2-id="select2-data-single-select-field" tabindex="-1"
                                        aria-hidden="true">
                                        <option data-select2-id="select2-data-2-tyfm"></option>

                                        @foreach ($group_name as $item)
                                            @if ($permission->group_name == $item->g_name)
                                                <option value="{{ $item->g_name }}" data-select2-id="{{ $item->id }}"
                                                    selected>
                                                    {{ $item->g_name }}</option>
                                            @else
                                                <option value="{{ $item->g_name }}" data-select2-id="{{ $item->id }}">
                                                    {{ $item->g_name }}</option>
                                            @endif
                                        @endforeach

                                    </select>

                                    @error('blogcat_id')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update Permission</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2-custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    group_name: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Permission Name',
                    },
                    group_name: {
                        required: 'Please Select Group Name',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
