@extends('admin.admin_dashboard')

@push('css')
    <style>
        .cst {
            background: aliceblue;
            cursor: no-drop;
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-plus"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.all.coupon') }}" class="btn btn-danger tbl-custom"><i
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

                        <form id="myForm" method="POST" action="{{ route('admin.update.coupon') }}" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $coupon->id }}">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coupon_name" class="form-label">Coupon Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror"
                                        name="coupon_name" id="coupon_name" placeholder="Coupon Name"
                                        value="{{ old('coupon_name', $coupon->coupon_name) }}">
                                    @error('coupon_name')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coupon_discount" class="form-label">Coupon Discount (%) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" min="0"
                                        class="form-control @error('coupon_discount') is-invalid @enderror"
                                        name="coupon_discount" id="coupon_discount" placeholder="Coupon Discount"
                                        value="{{ old('coupon_discount', $coupon->coupon_discount) }}">
                                    @error('coupon_discount')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coupon_validity" class="form-label">Coupon Validity Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('coupon_validity') is-invalid @enderror"
                                        name="coupon_validity" id="coupon_validity" placeholder="Coupon Validity"
                                        min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ old('coupon_validity', $coupon->coupon_validity) }}">
                                    @error('coupon_validity')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update Coupon</button>
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
                    coupon_name: {
                        required: true,
                    },
                    coupon_discount: {
                        required: true,
                    },
                    coupon_validity: {
                        required: true,
                    },

                },
                messages: {
                    coupon_name: {
                        required: 'Please Enter Coupon Name',
                    },
                    coupon_discount: {
                        required: 'Please Enter Coupon Discount',
                    },
                    coupon_validity: {
                        required: 'Please Select Coupon Validity Date',
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
