@extends('admin.admin_dashboard')

@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        tbody td {
            text-align: center;
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
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary tbl-custom"><i class="bx bx-plus"></i>Add
                        Instructor</a>
                </div>
            </div> --}}

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="review" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($review as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}.</td>
                                    <td>{{ $item->course->course_name }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->comment }}</td>
                                    <td>

                                        @if ($item->rating == null)
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                        @elseif ($item->rating == 1)
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                        @elseif ($item->rating == 2)
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                        @elseif ($item->rating == 3)
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                        @elseif ($item->rating == 4)
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-secondary"></span>
                                        @elseif ($item->rating == 5)
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                        @endif

                                    </td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="flexSwitchCheckChecked" data-user-id={{ $item->id }}
                                                {{ $item->status ? 'checked' : '' }}>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Rating</th>
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
            $('#review').DataTable({
                'sort': false,
            });
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
