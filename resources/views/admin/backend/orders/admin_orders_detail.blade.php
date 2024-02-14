@extends('admin.admin_dashboard')

@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.pending.order') }}" class="btn btn-danger tbl-custom"><i
                            class="bx bx-left-arrow-alt"></i>Back</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment Detail</h4>
                            </div>
                            <div class="card-body">


                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0 ">Name</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : {{ $payment->name }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : {{ $payment->email }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : {{ $payment->phone }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : {{ $payment->address }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Payment Type</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : {{ $payment->payment_type }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card">
                                <div class="card-body">

                                    @if ($payment->coupon_discount != 0 && $payment->coupon_name != '-' && $payment->discount_amount != 0)
                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0 ">Coupon Name</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                : {{ $payment->coupon_name }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0 ">Coupon Discount</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                : ${{ $payment->coupon_discount }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0 ">Discount Amount</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                : ${{ $payment->discount_amount }}
                                            </div>
                                        </div>
                                    @endif



                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 ">Total Amount</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            : ${{ $payment->total_amount }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 ">Payment Type</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            : <span class="badge bg-primary">{{ $payment->payment_type }}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 ">Invoice No</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            : {{ $payment->invoice_no }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 ">Order Date</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            : {{ $payment->order_date }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 ">Order Status</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            : @if ($payment->status == 'pending')
                                                <a href="" class="btn btn-block btn-success btn-sm">Confirm Order</a>
                                            @elseif($payment->status == 'confirm')
                                                <a href="" class="btn btn-block btn-success btn-sm">Confirm Order</a>
                                            @endif
                                        </div>
                                    </div>


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
@endpush
