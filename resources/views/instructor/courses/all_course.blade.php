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
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course') }}" class="btn btn-primary tbl-custom"><i class="bx bx-plus"></i>Add
                        Course</a>
                </div>
            </div>

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
                                <th>Image</th>
                                <th width="30px">Course Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ !empty($item->course_image) ? url($item->course_image) : url('upload/no_image.jpg') }}"
                                            alt="{{ $item->course_name_slug }}" width="80%" srcset="">
                                    </td>
                                    <td class="text-center">{{ $item->course_title }}</td>
                                    <td class="text-center">{{ $item->category->category_name }}</td>
                                    <td class="text-center">{{ $item->selling_price }}</td>
                                    <td class="text-center">{{ $item->discount_price }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit.course', $item->course_name_slug) }}"
                                            class="btn btn-success px-3" title="edit"><i class="lni lni-eraser"></i></a>
                                        <a href="{{ route('delete.course', $item->course_name_slug) }}"
                                            class="btn btn-danger px-3 " title="delete" id="delete"><i
                                                class="lni lni-trash"></i></a>
                                        <a href="{{ route('add.course.lecture', $item->id) }}"
                                            class="btn btn-secondary px-3" title="lecture"><i class="lni lni-list"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th width="30px">Course Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
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
            $('#course').DataTable();
        });
    </script>
@endpush
