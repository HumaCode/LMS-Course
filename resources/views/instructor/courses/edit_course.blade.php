@extends('instructor.instructor_dashboard')


@push('css')
    <style>
        .cst {
            background: aliceblue;
            cursor: no-drop;
        }

        .rw-cs {
            margin-left: -23px;
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

                        <form id="myForm" method="POST" action="{{ route('update.course') }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $course->id }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_name" class="form-label">Course Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('course_name') is-invalid @enderror"
                                        name="course_name" id="course_name" value="{{ $course->course_title }}">
                                    @error('course_name')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_name_slug" class="form-label">Course Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control cst @error('course_name_slug') is-invalid @enderror"
                                        name="course_name_slug" id="course_name_slug" placeholder="Auto-fill"
                                        value="{{ $course->course_name_slug }}" readonly>
                                    @error('course_name_slug')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">Course Category <span
                                            class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option selected disabled>Choose...</option>

                                        @foreach ($categories as $item)
                                            @if ($item->id == $course->category_id)
                                                <option value="{{ $item->id }}" selected>{{ $item->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_id" class="form-label">Course Sub Category <span
                                            class="text-danger">*</span></label>
                                    <select id="subcategory_id" name="subcategory_id"
                                        class="form-select @error('subcategory_id') is-invalid @enderror">

                                        <option disabled selected>Choose</option>

                                        @foreach ($subcategories as $item)
                                            @if ($item->id == $course->subcategory_id)
                                                <option value="{{ $item->id }}" selected>{{ $item->subcategory_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('subcategory_id')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="certificate" class="form-label">Certificate Available </label>
                                    <select id="certificate" name="certificate"
                                        class="form-select @error('certificate') is-invalid @enderror">
                                        <option selected disabled>Choose...</option>

                                        <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>No
                                        </option>

                                    </select>
                                    @error('certificate')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="label" class="form-label">Label <span
                                            class="text-danger">*</span></label>
                                    <select id="label" name="label"
                                        class="form-select @error('label') is-invalid @enderror ">
                                        <option selected disabled>Choose...</option>

                                        <option value="Beginner" {{ $course->label == 'Beginner' ? 'selected' : '' }}>
                                            Beginner</option>
                                        <option value="Middle" {{ $course->label == 'Middle' ? 'selected' : '' }}>Middle
                                        </option>
                                        <option value="Advance" {{ $course->label == 'Advance' ? 'selected' : '' }}>Advance
                                        </option>

                                    </select>

                                    @error('label')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="selling_price" class="form-label">Course Price<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('selling_price') is-invalid @enderror "
                                        type="text" name="selling_price" id="selling_price"
                                        value="{{ $course->selling_price }}">
                                    @error('selling_price')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input class="form-control @error('discount_price') is-invalid @enderror"
                                        type="text" name="discount_price" id="discount_price"
                                        value="{{ $course->discount_price }}">
                                    @error('discount_price')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration" class="form-label">Duration <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('duration') is-invalid @enderror" type="text"
                                        name="duration" id="duration" value="{{ $course->duration }}">
                                    @error('duration')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="resources" class="form-label">Resources <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('resources') is-invalid @enderror" type="text"
                                        name="resources" id="resources" value="{{ $course->resources }}">
                                    @error('resources')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="prerequisites" class="form-label">Course Prerequisites</label>
                                    <textarea class="form-control @error('prerequisites') is-invalid @enderror" name="prerequisites" id="prerequisites"
                                        placeholder="Prerequisites..." rows="3">{{ $course->prerequisites }}</textarea>
                                    @error('prerequisites')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Course Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="myeditorinstance"
                                        rows="3" placeholder="Description">{{ $course->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            {{ $course->bestseller == 1 ? 'checked' : '' }} id="bestseller"
                                            name="bestseller">
                                        <label class="form-check-label" for="bestseller">
                                            Bestseller
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ $course->featured == 1 ? 'checked' : '' }} value="1" id="featured"
                                            name="featured">
                                        <label class="form-check-label" for="featured">
                                            Featured
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="highestrated"
                                            name="highestrated" {{ $course->highestrated == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="highestrated">
                                            Highest Rated
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update Course</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.course.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <input type="hidden" name="old_image" value="{{ $course->course_image }}">


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_image" class="form-label">Course Image <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('course_image') is-invalid @enderror" type="file"
                                    name="course_image" id="image" accept=".jpg,.jpeg,.png">

                                @error('course_image')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ asset($course->course_image) }}" alt="Admin"
                                class="p-1 bg-primary" width="20%"> <br>
                            <span class="text-danger">* Max file size is 2MB, Suitable files are jpg, png and
                                jpeg.</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                    class="bx bx-save"></i>Update Image</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table',
            height: 350,
            init_instance_callback: function(editor) {
                var freeTiny = document.querySelector('.tox .tox-notification--in');
                freeTiny.style.display = 'none';
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    course_name: {
                        required: true,
                    },
                    course_name_slug: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                    certificate: {
                        required: true,
                    },
                    label: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    discount_price: {
                        required: true,
                    },
                    duration: {
                        required: true,
                    },
                    resources: {
                        required: true,
                    },
                    prerequisites: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },

                },
                messages: {
                    course_name: {
                        required: 'Please Enter Course Name',
                    },
                    course_name_slug: {
                        required: 'Please Enter Course Name Slug',
                    },
                    category_id: {
                        required: 'Please Choose Course Category',
                    },
                    category_id: {
                        required: 'Please Choose Course Subcategory',
                    },
                    certificate: {
                        required: 'Please Choose Course Sertificate',
                    },
                    label: {
                        required: 'Please Choose Course Label',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    discount_price: {
                        required: 'Please Enter Discount Price',
                    },
                    duration: {
                        required: 'Please Enter Duration',
                    },
                    resources: {
                        required: 'Please Enter Resources',
                    },
                    prerequisites: {
                        required: 'Please Enter Prerequisites',
                    },
                    description: {
                        required: 'Please Enter Description',
                    },
                    image: {
                        required: 'Please Select Course Image',
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
