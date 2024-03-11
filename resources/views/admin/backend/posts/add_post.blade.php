@extends('admin.admin_dashboard')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <link href="{{ asset('backend') }}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        .cst {
            background: aliceblue;
            cursor: no-drop;
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
                    <a href="{{ route('admin.blog.post') }}" class="btn btn-danger tbl-custom"><i
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_title" class="form-label">Post Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="post_title" id="post_title"
                                        placeholder="Post Title">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_slug" class="form-label">Post Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control cst" name="post_slug" id="post_slug"
                                        placeholder="Auto-fill" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blogcat_id" class="form-label">Category Post <span
                                            class="text-danger">*</span></label>
                                    <select name="blogcat_id" class="form-select select2-hidden-accessible"
                                        id="single-select-field" data-placeholder="Choose one thing"
                                        data-select2-id="select2-data-single-select-field" tabindex="-1"
                                        aria-hidden="true">
                                        <option data-select2-id="select2-data-2-tyfm"></option>

                                        @foreach ($blogcat as $item)
                                            <option value="{{ $item->id }}" data-select2-id="{{ $item->id }}">
                                                {{ $item->category_name }}</option>
                                        @endforeach

                                    </select>

                                    @error('blogcat_id')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="long_descp" class="form-label">Description</label>
                                    <textarea class="form-control @error('long_descp') is-invalid @enderror" name="long_descp" id="myeditorinstance"
                                        rows="3" placeholder="Description"></textarea>
                                    @error('long_descp')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Post Tag <span class="text-danger">*</span></label>
                                    <input type="text" name="post_tag" class="form-control" data-role="tagsinput">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="post_image" class="form-label">Post Image <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="post_image" id="image"
                                        accept=".jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Post Image"
                                    class="p-1 bg-primary" width="20%"> <br>
                                <span class="text-danger">* Max file size is 2MB, Suitable files are jpg, png and
                                    jpeg.</span>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Add Blog</button>
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

    {{-- tag --}}
    <script src="{{ asset('backend') }}/assets/plugins/input-tags/js/tagsinput.js"></script>

    <script src="https://cdn.tiny.cloud/1/re1hyyagcsptel9z6bg836dptpkbrbpua7kjc4rgae0ap8kj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300,
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    post_title: {
                        required: true,
                    },
                    post_slug: {
                        required: true,
                    },

                },
                messages: {
                    post_title: {
                        required: 'Please Enter Post Title',
                    },
                    post_slug: {
                        required: 'Please Enter Post Slug',
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
        const title = document.querySelector('#post_title');
        const slug = document.querySelector('#post_slug');

        title.addEventListener('change', function() {
            fetch('/blog-post/checkSlug?post_title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.post_slug)
        });
    </script>
@endpush
