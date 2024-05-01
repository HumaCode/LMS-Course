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
                    <a href="{{ route('instructor.add.coupon') }}" class="btn btn-primary tbl-custom"><i
                            class="bx bx-plus"></i>Add
                        Coupon</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">

                <div id="app">
                    <chat-message></chat-message>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('script')
@endpush
