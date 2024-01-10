@extends('instructor.instructor_dashboard')


@push('css')
    <style>
        .cst {
            background: aliceblue;
            cursor: no-drop;
        }
    </style>
@endpush

@section('instructor')
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
                    <a href="{{ route('all.course') }}" class="btn btn-danger tbl-custom"><i
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

                        <form id="myForm" method="POST" action="{{ route('store.category') }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_name" class="form-label">Course Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course_name" id="course_name"
                                        placeholder="Course Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_name_slug" class="form-label">Course Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control cst" name="course_name_slug"
                                        id="course_name_slug" placeholder="Auto-fill" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">Course Category <span
                                            class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option selected disabled>Choose...</option>

                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach

                                    </select>
                                    {{-- @error('category_id')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_id" class="form-label">Course Sub Category <span
                                            class="text-danger">*</span></label>
                                    <select id="subcategory_id" name="subcategory_id" class="form-select " required>
                                        <option selected disabled>Choose...</option>

                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_image" class="form-label">Course Image <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="image" id="image"
                                        accept=".jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                    class="p-1 bg-primary" width="20%"> <br>
                                <span class="text-danger">* Max file size is 2MB, Suitable files are jpg, png and
                                    jpeg.</span>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video" class="form-label">Video Course Intro<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="video" id="video">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate" class="form-label">Certificate Available </label>
                                    <select id="certificate" name="certificate" class="form-select " required>
                                        <option selected disabled>Choose...</option>

                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selling_price" class="form-label">Course Price<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="selling_price" id="selling_price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input class="form-control" type="text" name="discount_price"
                                        id="discount_price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration" class="form-label">Duration <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="duration" id="duration">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="resources" class="form-label">Resources <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="resources" id="resources">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="resources" class="form-label">Course Prerequisites</label>
                                    <textarea class="form-control name="prerequisites" id="prerequisites" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Add Course</button>
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


        // slug
        const name = document.querySelector('#course_name');
        const slug = document.querySelector('#course_name_slug');

        name.addEventListener('change', function() {
            fetch('/course/checkSlug?course_name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.course_name_slug)
        });
    </script>
@endpush
