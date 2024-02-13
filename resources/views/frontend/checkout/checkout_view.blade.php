@extends('frontend.master')

@push('css')
    <style>
        .stripe {
            top: 9px;
        }
    </style>
@endpush

@section('home')
    {{-- START BREADCRUMB AREA --}}
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Checkout</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </section>


    {{-- START CONTACT AREA --}}
    <section class="cart-area section--padding">
        <div class="container">
            <div class="row">

                <form method="post" action="{{ route('payment') }}" enctype="multipart/form-data" class="row">
                    @csrf


                    <div class="col-lg-7">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-22 pb-3">Billing Details</h3>
                                <div class="divider"><span></span></div>

                                <div class="row">
                                    <div class="input-box col-lg-6">
                                        <label class="label-text">Name <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control form--control @error('name') is-invalid @enderror"
                                                type="text" name="name" placeholder="Enter Name"
                                                value="{{ Auth::user()->name }}">
                                            <span class="la la-user input-icon"></span>
                                            @error('name')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><!-- end input-box -->

                                    <div class="input-box col-lg-6">
                                        <label class="label-text">Email <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control form--control @error('email') is-invalid @enderror"
                                                type="email" name="email" placeholder="Enter Email"
                                                value="{{ Auth::user()->email }}">
                                            <span class="la la-envelope input-icon"></span>
                                            @error('email')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><!-- end input-box -->


                                    <div class="input-box col-lg-12">
                                        <label class="label-text">Address <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control form--control @error('address') is-invalid @enderror"
                                                type="text" name="address" placeholder="Enter Address"
                                                value="{{ Auth::user()->address }}">
                                            <span class="la la-map-marker input-icon"></span>
                                            @error('address')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box col-lg-12">
                                        <label class="label-text">Phone Number <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input id="phone"
                                                class="form-control form--control @error('phone') is-invalid @enderror"
                                                type="number" name="phone" min="0"
                                                value="{{ Auth::user()->phone }}">
                                            <span class="la la-phone input-icon"></span>
                                            @error('phone')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div><!-- end input-box -->
                                </div>

                            </div><!-- end card-body -->
                        </div><!-- end card -->

                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-22 pb-3">Select Payment Method</h3>
                                <div class="divider"><span></span></div>
                                <div class="payment-option-wrap">

                                    <div class="payment-tab is-active">

                                        <div class="payment-tab-toggle">
                                            <input checked id="handcash" name="cash_delivery" type="radio"
                                                value="handcash">
                                            <label for="handcash">Direct Payment</label>
                                        </div>

                                    </div><!-- end payment-tab -->

                                    <div class="payment-tab">
                                        <div class="payment-tab-toggle">
                                            <input id="stripe" name="cash_delivery" type="radio" value="stripe">
                                            <label for="stripe">Stripe Payment</label>
                                            <img class="payment-logo stripe"
                                                src="{{ asset('frontend') }}/images/logostripe.png" alt="">
                                        </div>
                                        <div class="payment-tab-content">
                                            <p class="fs-15 lh-24">In order to complete your transaction, we will transfer
                                                you
                                                over to Stripe's secure servers.</p>
                                        </div>
                                    </div><!-- end payment-tab -->


                                    {{-- <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input id="paypal" name="cash_delivery" type="radio" value="paypal">
                                        <label for="paypal">PayPal</label>
                                        <img class="payment-logo" src="{{ asset('frontend') }}/images/paypal.png"
                                            alt="">
                                    </div>
                                    <div class="payment-tab-content">
                                        <p class="fs-15 lh-24">In order to complete your transaction, we will transfer you
                                            over to PayPal's secure servers.</p>
                                    </div>
                                </div><!-- end payment-tab --> --}}

                                    {{-- <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input type="radio" name="radio" id="creditCart" value="creditCard">
                                        <label for="creditCart">Credit / Debit Card</label>
                                        <img class="payment-logo" src="{{ asset('frontend') }}/images/payment-img.png"
                                            alt="">
                                    </div>
                                    <div class="payment-tab-content">
                                        <form action="#" class="row">
                                            <div class="input-box col-lg-6">
                                                <label class="label-text">Name on Card</label>
                                                <div class="form-group">
                                                    <input class="form-control form--control pl-3" type="text"
                                                        name="text" placeholder="Card Name">
                                                </div>
                                            </div>
                                            <div class="input-box col-lg-6">
                                                <label class="label-text">Card Number</label>
                                                <div class="form-group">
                                                    <input class="form-control form--control pl-3" type="text"
                                                        name="text" placeholder="1234  5678  9876  5432">
                                                </div>
                                            </div>
                                            <div class="input-box col-lg-4">
                                                <label class="label-text">Expiry Month</label>
                                                <div class="form-group">
                                                    <input class="form-control form--control pl-3" type="text"
                                                        name="text" placeholder="MM">
                                                </div>
                                            </div>
                                            <div class="input-box col-lg-4">
                                                <label class="label-text">Expiry Year</label>
                                                <div class="form-group">
                                                    <input class="form-control form--control pl-3" type="text"
                                                        name="text" placeholder="YY">
                                                </div>
                                            </div>
                                            <div class="input-box col-lg-4">
                                                <label class="label-text">CVV</label>
                                                <div class="form-group">
                                                    <input class="form-control form--control pl-3" type="text"
                                                        name="text" placeholder="cvv">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div><!-- end payment-tab --> --}}
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-7 -->
                    <div class="col-lg-5">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-22 pb-3">Order Details</h3>
                                <div class="divider"><span></span></div>
                                <div class="order-details-lists">

                                    @foreach ($carts as $item)
                                        <input type="hidden" name="slug[]" value="{{ $item->options->slug }}">
                                        <input type="hidden" name="course_id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="course_title[]" value="{{ $item->name }}">
                                        <input type="hidden" name="price[]" value="{{ $item->price }}">
                                        <input type="hidden" name="instructor_id[]"
                                            value="{{ $item->options->instructor }}">

                                        <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                            <a href="{{ url('course/details/' . $item->id . '/' . $item->options->slug) }}"
                                                class="media-img">
                                                <img src="{{ $item->options->image }}" alt="Cart image">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="fs-15 pb-2"><a
                                                        href="{{ url('course/details/' . $item->id . '/' . $item->options->slug) }}">{{ $item->name }}</a>
                                                </h5>
                                                <p class="text-black font-weight-semi-bold lh-18">${{ $item->price }}
                                                </p>
                                            </div>
                                        </div><!-- end media -->
                                    @endforeach


                                </div><!-- end order-details-lists -->
                                <a href="{{ route('mycart') }}" class="btn-text"><i class="la la-edit mr-1"></i>Edit</a>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-22 pb-3">Order Summary</h3>
                                <div class="divider"><span></span></div>

                                @if (Session::has('coupon'))
                                    <ul class="generic-list-item generic-list-item-flash fs-15">
                                        <li
                                            class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="text-black">SubTotal :</span>
                                            <span>${{ $cartTotal }}</span>
                                        </li>
                                        <li
                                            class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="text-black">Coupon Name :</span>
                                            <span>{{ session()->get('coupon')['coupon_name'] }}
                                                ( {{ session()->get('coupon')['coupon_discount'] }}% )</span>
                                        </li>
                                        <li
                                            class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="text-black">Coupon Discount :</span>
                                            <span>${{ session()->get('coupon')['discount_amount'] }} </span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                            <span class="text-black">Total :</span>
                                            <span>${{ session()->get('coupon')['total_amount'] }}</span>
                                        </li>
                                    </ul>

                                    <input type="hidden" name="total" value="{{ $cartTotal }}">
                                @else
                                    <ul class="generic-list-item generic-list-item-flash fs-15">
                                        <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                            <span class="text-black">Total :</span>
                                            <span>${{ $cartTotal }}</span>
                                        </li>
                                    </ul>

                                    <input type="hidden" name="total" value="{{ $cartTotal }}">
                                @endif





                                <div class="btn-box border-top border-top-gray pt-3">
                                    <p class="fs-14 lh-22 mb-2">Aduca is required by law to collect applicable transaction
                                        taxes for purchases made in certain tax jurisdictions.</p>
                                    <p class="fs-14 lh-22 mb-3">By completing your purchase you agree to these <a
                                            href="#" class="text-color hover-underline">Terms of Service.</a></p>


                                    <button type="submit" class="btn theme-btn w-100">Proceed <i
                                            class="la la-arrow-right icon ml-1"></i></button>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-5 -->
                </form>

            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
