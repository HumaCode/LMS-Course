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
                                        : {{ strtoupper($payment->cash_delivery) }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">

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
                                            : {{ $payment->coupon_discount }}%
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
                                        <h6 class="mb-0 ">Order Status</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        : @if ($payment->status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                        @elseif($payment->status == 'confirm')
                                            <span class="badge bg-success">Confirmed</span>
                                        @endif
                                    </div>
                                </div>

                                @if ($payment->status == 'pending')
                                    <div class="row">
                                        <div class="col-sm-12 text-secondary">

                                            <a href="{{ route('admin-pending-confirm', $payment->id) }}"
                                                class="btn btn-block btn-primary btn-sm" id="confirm">Confirm Order</a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div class="flex-grow-1 ms-3">
                                        <div class="table-responsive">
                                            <table class="table" style="font-weight: 600;">
                                                <tbody>
                                                    <tr>
                                                        <td class="col-md-1">
                                                            <label for="">Image</label>
                                                        </td>
                                                        <td class="col-md-2">
                                                            <label for="">Course Name</label>
                                                        </td>
                                                        <td class="col-md-2">
                                                            <label for="">Category</label>
                                                        </td>
                                                        <td class="col-md-2">
                                                            <label for="">Instructor</label>
                                                        </td>
                                                        <td class="col-md-2">
                                                            <label for="">Price</label>
                                                        </td>
                                                    </tr>

                                                    @php
                                                        $discount_amount = $payment->discount_amount;
                                                        $totalPrice = 0;
                                                    @endphp


                                                    @foreach ($order_item as $item)
                                                        <tr>
                                                            <td class="col-md-1">
                                                                <label for="">
                                                                    <img src="{{ asset($item->course->course_image) }}"
                                                                        alt="" style="width: 70px; height: 50px;">
                                                                </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for=""> {{ $item->course->course_name }}
                                                                </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for="">
                                                                    {{ $item->course->category->category_name }}
                                                                </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for="">
                                                                    {{ $item->instructor->name }}
                                                                </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for="">
                                                                    ${{ $item->price }}
                                                                </label>
                                                            </td>
                                                        </tr>

                                                        @php
                                                            $totalPrice += $item->price;
                                                        @endphp
                                                    @endforeach

                                                    @if ($discount_amount > 0)
                                                        <tr>
                                                            <td colspan="4">Discount Amount</td>
                                                            <td class="col-md-3">
                                                                <strong> ${{ $discount_amount }}</strong>
                                                            </td>
                                                        </tr>
                                                    @endif


                                                    <tr>
                                                        <td colspan="4">Total Price</td>
                                                        <td class="col-md-3">
                                                            <strong>
                                                                ${{ $totalPrice - $discount_amount }}</strong>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
