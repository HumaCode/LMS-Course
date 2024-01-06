@extends('admin.admin_dashboard')

@push('css')
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.category') }}" class="btn btn-danger tbl-custom"><i
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

                        <form id="myForm" method="POST" action="" enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_name" class="form-label">Category Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_name" id="category_name"
                                        placeholder="Category Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_slug" class="form-label">Category Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_slug" id="category_slug">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_slug" class="form-label">Category Image <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="image" id="image"
                                        accept=".jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                    class="p-1 bg-primary" width="20%">
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Add Category</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                    category_slug: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },

                },
                messages: {
                    category_name: {
                        required: 'Please Enter Category Name',
                    },
                    category_slug: {
                        required: 'Please Enter Category Slug',
                    },
                    image: {
                        required: 'Please Select Category Image',
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


        // image picker
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endpush
