@extends('admin.admin_dashboard')

@push('css')
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
                    <a href="{{ route('all.subcategory') }}" class="btn btn-danger tbl-custom"><i
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

                        <form id="myForm" method="POST" action="{{ route('update.subcategory') }}" class="row g-3">
                            @csrf


                            <input type="hidden" name="id" value="{{ $subcategory->category_id }}">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">Category Name <span
                                            class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option selected disabled>Choose...</option>

                                        @foreach ($category as $item)
                                            @if ($subcategory->category_id == $item->id)
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
                                    <label for="subcategory_name" class="form-label">Sub Category Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('subcategory_name') is-invalid @enderror"
                                        name="subcategory_name" id="subcategory_name" placeholder="Sub Category Name"
                                        value="{{ $subcategory->subcategory_name }}">
                                    @error('subcategory_name')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_slug" class="form-label">Sub Category Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control cst @error('subcategory_slug') is-invalid @enderror"
                                        name="subcategory_slug" id="subcategory_slug" placeholder="Auto-fill"
                                        value="{{ $subcategory->subcategory_slug }}" readonly>
                                    @error('subcategory_slug')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update Sub Category</button>
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
                    category_id: {
                        required: true,
                    },
                    subcategory_name: {
                        required: true,
                    },
                    subcategory_slug: {
                        required: true,
                    },

                },
                messages: {
                    category_id: {
                        required: 'Please Select Category Name',
                    },
                    subcategory_name: {
                        required: 'Please Enter Sub Category Name',
                    },
                    subcategory_slug: {
                        required: 'Please Enter Sub Category Slug',
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

        // slug
        const name = document.querySelector('#subcategory_name');
        const slug = document.querySelector('#subcategory_slug');

        name.addEventListener('change', function() {
            fetch('/subcategory/checkSlugSubCategory?subcategory_name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.subcategory_slug)
        });
    </script>
@endpush
