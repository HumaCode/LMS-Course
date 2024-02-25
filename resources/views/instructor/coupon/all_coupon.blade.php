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
                    <a href="{{ route('admin.add.coupon') }}" class="btn btn-primary tbl-custom"><i
                            class="bx bx-plus"></i>Add
                        Coupon</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="coupon" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $coupon->coupon_name }}</td>
                                    <td class="text-center">{{ $coupon->coupon_discount }}%</td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}</td>
                                    <td>
                                        @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge bg-success">Valid</span>
                                        @else
                                            <span class="badge bg-danger">Invalid</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.edit.coupon', $coupon->id) }}"
                                            class="btn btn-success px-5"><i class="bx bx-edit-alt"></i>Edit</a>
                                        <a href="{{ route('admin.delete.coupon', $coupon->id) }}"
                                            class="btn btn-danger px-5" id="delete"><i
                                                class="bx bx-trash-alt"></i>Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
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
            $('#coupon').DataTable({
                'sort': false,
            });
        });
    </script>
@endpush
