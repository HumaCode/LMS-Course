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


                        <button type="button" class="btn btn-primary mt-2 tbl-custom" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bx bx-plus"></i>Add Section</button>
                    </div>
                </div>
            </div>

        </div>

        @foreach ($section as $key => $item)
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <h6>{{ $item->section_title }}</h6>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-danger "> <i class="lni lni-trash"></i>Delete
                                            Section</button> &nbsp;

                                        <a onclick="addLectureDiv({{ $course->id }}, {{ $item->id }}, 'lectureContainer{{ $key }}')"
                                            id="addLectureBtn($key)" class="btn btn-primary"><i class="bx bx-plus"></i>Add
                                            Lecture</a>
                                    </div>

                                </div>


                                <div class="courseHide" id="lectureContainer{{ $key }}">
                                    <div class="container">
                                        <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <strong>Lecture Title</strong>
                                            </div>

                                            <div class="btn-group">
                                                <a href="" class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('add.course.section') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="section_title" class="form-label">Course Section <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('section_title') is-invalid @enderror"
                                    name="section_title" id="section_title" placeholder="Course Section" required>
                                @error('section_title')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger tbl-custom" data-bs-dismiss="modal"><i
                                class="lni lni-ban"></i>Close</button>
                        <button type="submit" class="btn btn-primary tbl-custom"> <i class="lni lni-save"></i> Add</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        function addLectureDiv(courseId, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId);

            const newLectureDiv = document.createElement('div');
            newLectureDiv.classList.add('lectureDiv', 'mb-3');

            newLectureDiv.innerHTML = `
            <div class="container">
                <h6>Lecture Title</h6>
                <input type="text" class="form-control" placeholder="Enter Lecture Title">
                <textarea name="" id="" class="form-control mt-2" cols="" rows="3"
                    placeholder="Enter Lecture Content"></textarea>

                <h6 class="mt-3">Add Video Url</h6>
                <input type="text" name="url" class="form-control" placeholder="Add URL">


                <button class="btn btn-primary mt-3 btn-sm" onclick="saveLecture('${courseId}', '${sectionId}', ${containerId})">Save Lecture</button>
                <button class="btn btn-secondary mt-3 btn-sm" onclick="hideLectureContainer('${containerId}')">Cancle</button>
            </div>
            `;

            lectureContainer.appendChild(newLectureDiv);

        }

        function hideLectureContainer(containerId) {
            const lectureContainer = document.getElementById(containerId);
            lectureContainer.style.display = 'none';
            location.reload();
        }
    </script>

    <script>
        function saveLecture(courseId, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId);
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
            const lectureContent = lectureContainer.querySelector('textarea').value;
            const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;

            fetch('/save-lecture', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                        course_id: courseId,
                        section_id: sectionId,
                        lecture_title: lectureTitle,
                        lecture_url: lectureUrl,
                        content: lectureContent,
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
        }
    </script>
@endpush
