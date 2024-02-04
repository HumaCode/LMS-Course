@extends('admin.admin_dashboard')

@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div> --}}


        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border"
                                        width="90" height="90" alt="{{ $course->course_name }}">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mt-0">{{ $course->course_name }}</h5>
                                        <p class="mb-0">{{ $course->course_title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Category</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->category->category_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sub Category</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->subcategory->subcategory_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Instructor</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->user->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Label</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->label }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Duration</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->duration }} Hours</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Video</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td>
                                                <video width="300" height="200" controls>
                                                    <source src="{{ asset($course->video) }}" type="video/mp4">
                                                </video>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Resources</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->resources }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Certificate</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ $course->certificate }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Price</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>${{ $course->selling_price }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discount</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td><strong>${{ $course->discount_price ?? '-' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong> </td>
                                            <td><strong>:</strong></td>
                                            <td>
                                                @if ($course->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
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
