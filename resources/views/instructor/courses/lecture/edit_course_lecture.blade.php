@extends('instructor.instructor_dashboard')

@push('css')
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
                    <a href="{{ route('add.course.lecture', $clecture->course_id) }}" class="btn btn-danger tbl-custom"><i
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

                        <form id="myForm" method="POST" action="{{ route('update.course.lecture') }}" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $clecture->id }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lecture_title" class="form-label">Lecture Title</label>
                                    <input type="text" class="form-control" name="lecture_title" id="lecture_title"
                                        placeholder="Lecture Title" value="{{ $clecture->lecture_title }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video" class="form-label">Video Url </label>
                                    <input type="text" class="form-control" name="video" id="video"
                                        placeholder="Video Url" value="{{ $clecture->video }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content" class="form-label">Lecture Content</label>

                                    <textarea name="content" id="content" cols="30" rows="5" class="form-control">{{ $clecture->content }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="url" class="form-label">Resource Url </label>
                                    <input type="text" class="form-control" name="url" id="url"
                                        placeholder="Resource Url" value="{{ $clecture->url }}">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Edit Course Lecture</button>
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
                    lecture_title: {
                        required: true,
                    },



                },
                messages: {
                    lecture_title: {
                        required: 'Please Enter Lecture Title',
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
