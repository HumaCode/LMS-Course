@extends('instructor.instructor_dashboard')


@section('instructor')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">
                                <i class="fadeIn animated bx bx-user-circle"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.course') }}" class="btn btn-danger tbl-custom"><i
                            class="bx bx-left-arrow-alt"></i>Back
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />


        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90"
                        height="90" alt="...">
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">{{ $course->course_name }}</h5>
                        <p class="mb-0">{{ $course->course_title }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
