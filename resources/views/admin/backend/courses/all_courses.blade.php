@extends('admin.admin_dashboard')

@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        tbody td {

            vertical-align: middle;
        }

        .large-checkbox {
            transform: scale(1.5)
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-category-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary tbl-custom"><i class="bx bx-plus"></i>Add
                        Course</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="courses" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ !empty($item->course_image) ? url($item->course_image) : url('upload/no_image.jpg') }}"
                                            alt="{{ $item->course_name }}" width="50%" srcset="">
                                    </td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td>${{ $item->selling_price }}</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-primary" title="Detail"><i
                                                class="lni lni-eye"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="flexSwitchCheckChecked" data-user-id={{ $item->id }}
                                                {{ $item->status ? 'checked' : '' }}>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                                <th>Status</th>
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
            $('#courses').DataTable();
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                var userId = $(this).data('user-id');
                var isChecked = $(this).is(':checked');


                $.ajax({
                    url: "{{ route('update.user.stauts') }}",
                    method: "POST",
                    data: {
                        user_id: userId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function() {

                    }
                })
            })
        });
    </script>
@endpush
