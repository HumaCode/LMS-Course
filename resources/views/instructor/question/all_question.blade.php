@extends('instructor.instructor_dashboard')

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        tbody td {
            text-align: center;
            vertical-align: middle;
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-category-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course') }}" class="btn btn-primary tbl-custom"><i class="bx bx-plus"></i>Add
                        Course</a>
                </div>
            </div> --}}

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="course" class="table table-striped table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Subject</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($question as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}.</td>
                                    <td class="text-center">{{ $item->course->course_name }}</td>
                                    <td class="text-center">{{ $item->subject }}</td>
                                    <td class="text-center">{{ $item->user->name }}</td>
                                    <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('instructor.question.detail', $item->id) }}"
                                            class="btn btn-success px-3" title="detail"><i class="lni lni-eye"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Subject</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#course').DataTable({
                'sort': false,
            });
        });
    </script>
@endpush
