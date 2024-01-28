@extends('frontend.dashboard.user_dashboard')

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::findOrFail($id);
@endphp

@section('userdashboard')
    <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
        <div class="media media-card align-items-center">
            <div class="media-img media--img media-img-md rounded-full">
                <img class="rounded-full"
                    src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                    alt="Student thumbnail image">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Hello, {{ $profileData->name }}</h2>
                <div class="rating-wrap d-flex align-items-center pt-2">
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
            </div><!-- end media-body -->
        </div><!-- end media -->
        {{-- <div class="file-upload-wrap file-upload-wrap-2 file--upload-wrap">
            <input type="file" name="files[]" class="multi file-upload-input">
            <span class="file-upload-text"><i class="la la-upload mr-2"></i>Upload a course</span>
        </div><!-- file-upload-wrap --> --}}
    </div>

    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">My Bookmarks</h3>
    </div>

    <div class="row">

        <div class="col-lg-4 responsive-column-half">
            <div class="card card-item">
                <div class="card-image">
                    <a href="course-details.html" class="d-block">
                        <img class="card-img-top" src="{{ asset('frontend') }}/images/img8.jpg" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Bestseller</div>
                        <div class="course-badge blue">-39%</div>
                    </div>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                    <h5 class="card-title"><a href="course-details.html">The Business Intelligence Analyst Course 2021</a>
                    </h5>
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
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip"
                            data-placement="top" title="Remove from Wishlist"><i class="la la-heart"></i></div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 -->

    </div><!-- end row -->

    <div class="text-center py-3">
        <nav aria-label="Page navigation example" class="pagination-box">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
        <p class="fs-14 pt-2">Showing 1-4 of 16 results</p>
    </div>
@endsection
