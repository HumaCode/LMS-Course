@extends('frontend.master')


@section('home')
    {{-- breadcrumb --}}
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Shopping Cart</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>Pages</li>
                    <li>Shopping Cart</li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section>


    {{-- cart --}}
    <section class="cart-area section-padding">
        <div class="container">
            <div class="table-responsive">
                <table class="table generic-table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product Details</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a href="course-details.html" class="media-img mr-0">
                                        <img src="{{ asset('frontend') }}/images/small-img.jpg" alt="Cart image">
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a href="course-details.html" class="text-black font-weight-semi-bold">The Complete
                                    Financial Analyst Course 2019</a>
                                <p class="fs-14 text-gray lh-20">By <a href="teacher-detail.html"
                                        class="text-color hover-underline">Mark Hardson</a>, Master Digital Marketing:
                                    Strategy, Social Media Marketing, SEO, YouTube, Email, Facebook Marketing, Analytics
                                    &amp; More!</p>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">$22.99</li>
                                    <li class="before-price lh-18">$55.99</li>
                                </ul>
                            </td>
                            <td>
                                <div class="quantity-item d-flex align-items-center">
                                    <button class="qtyBtn qtyDec"><i class="la la-minus"></i></button>
                                    <input class="qtyInput" type="text" name="qty-input" value="1">
                                    <button class="qtyBtn qtyInc"><i class="la la-plus"></i></button>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="icon-element icon-element-xs shadow-sm border-0"
                                    data-toggle="tooltip" data-placement="top" title="Remove">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a href="course-details.html" class="media-img mr-0">
                                        <img src="{{ asset('frontend') }}/images/small-img.jpg" alt="Cart image">
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a href="course-details.html" class="text-black font-weight-semi-bold">The Complete
                                    Financial Analyst Course 2019</a>
                                <p class="fs-14 text-gray lh-20">By <a href="teacher-detail.html"
                                        class="text-color hover-underline">Mark Hardson</a>, Master Digital Marketing:
                                    Strategy, Social Media Marketing, SEO, YouTube, Email, Facebook Marketing, Analytics
                                    &amp; More!</p>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">$22.99</li>
                                    <li class="before-price lh-18">$55.99</li>
                                </ul>
                            </td>
                            <td>
                                <div class="quantity-item d-flex align-items-center">
                                    <button class="qtyBtn qtyDec"><i class="la la-minus"></i></button>
                                    <input class="qtyInput" type="text" name="qty-input" value="1">
                                    <button class="qtyBtn qtyInc"><i class="la la-plus"></i></button>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="icon-element icon-element-xs shadow-sm border-0"
                                    data-toggle="tooltip" data-placement="top" title="Remove">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex flex-wrap align-items-center justify-content-between pt-4">
                    <form method="post">
                        <div class="input-group mb-2">
                            <input class="form-control form--control pl-3" type="text" name="search"
                                placeholder="Coupon code">
                            <div class="input-group-append">
                                <button class="btn theme-btn">Apply Code</button>
                            </div>
                        </div>
                    </form>
                    <a href="#" class="btn theme-btn mb-2">Update Cart</a>
                </div>
            </div>
            <div class="col-lg-4 ml-auto">
                <div class="bg-gray p-4 rounded-rounded mt-40px">
                    <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                    <div class="divider"><span></span></div>
                    <ul class="generic-list-item pb-4">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal:</span>
                            <span>$44.99</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Total:</span>
                            <span>$44.99</span>
                        </li>
                    </ul>
                    <a href="checkout.html" class="btn theme-btn w-100">Checkout <i
                            class="la la-arrow-right icon ml-1"></i></a>
                </div>
            </div>
        </div><!-- end container -->
    </section>

    {{-- course area --}}
    <section class="course-area section--padding bg-gray">
        <div class="course-wrapper">
            <div class="container">
                <div class="section-heading">
                    <h2 class="section__title">You may also like</h2>
                </div><!-- end section-heading -->
                <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img8.jpg"
                                    alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge">Bestseller</div>
                                <div class="course-badge blue">-39%</div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">12.99 <span
                                        class="before-price font-weight-medium">129.99</span></p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img9.jpg"
                                    alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge">Bestseller</div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">129.99</p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img10.jpg"
                                    alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge green">Free</div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">Free</p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img11.jpg"
                                    alt="Card image cap">
                            </a>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">129.99</p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img12.jpg"
                                    alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge">Featured</div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">129.99</p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-image">
                            <a href="course-details.html" class="d-block">
                                <img class="card-img-top" src="{{ asset('frontend') }}/images/img13.jpg"
                                    alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge">Featured</div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                            <h5 class="card-title"><a href="course-details.html">The Complete WordPress Website Business
                                    Course</a></h5>
                            <p class="card-text"><a href="teacher-detail.html">Jose Portilla</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">129.99</p>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end tab-content -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section>
@endsection
