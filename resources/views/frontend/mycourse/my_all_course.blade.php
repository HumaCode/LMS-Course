@extends('frontend.dashboard.user_dashboard')

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::findOrFail($id);
@endphp

@push('css')
    <style>
        .card-item-list-layout .card-image .card-img-top {
            object-fit: fill;
        }
    </style>
@endpush

@section('userdashboard')
    <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
        <div class="media media-card align-items-center">
            <div class="media-img media--img media-img-md rounded-full">
                <img class="rounded-full"
                    src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                    alt="Student image">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Hello, {{ $profileData->name }}</h2>
            </div><!-- end media-body -->
        </div><!-- end media -->

    </div><!-- end breadcrumb-content -->

    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
    </div>

    {{-- course --}}
    <div class="dashboard-cards mb-5">


        @forelse ($mycoruse as $item)
            <div class="card card-item card-item-list-layout">
                <div class="card-image">
                    <a href="course-details.html" class="d-block">
                        <img class="card-img-top" src="{{ asset($item->course->course_image) }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">

                        @php
                            $amount = $item->course->selling_price - $item->course->discount_price;
                            $discount = ($amount / $item->course->selling_price) * 100;
                        @endphp

                        @if ($item->course->bestseller == 1)
                            <div class="course-badge">Bestseller</div>
                        @else
                        @endif

                        @if ($item->course->discount_price == null)
                            <div class="course-badge red">New</div>
                        @else
                            <div class="course-badge blue">{{ round($discount) }}%</div>
                        @endif

                    </div>
                </div><!-- end card-image -->

                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $item->course->label }}</h6>
                    <h5 class="card-title"><a href="course-details.html">{{ $item->course->course_name }}</a>
                    </h5>
                    <p class="card-text"><a href="teacher-detail.html">{{ $item->course->user->name }}</a></p>
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
                    <ul class="card-duration d-flex align-items-center fs-15 pb-2">
                        <li class="mr-2">
                            <span class="text-black">Status:</span>
                            <span class="badge badge-success text-white">Published</span>
                        </li>
                        <li class="mr-2">
                            <span class="text-black">Duration:</span>
                            <span>{{ $item->course->duration }} Hours</span>
                        </li>
                        <li class="mr-2">
                            <span class="text-black">Students:</span>
                            <span>30,405</span>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">

                        @if ($item->course->discount_price == null)
                            <p class="card-price text-black font-weight-bold">$
                                {{ $item->course->selling_price }}</p>
                        @else
                            <p class="card-price text-black font-weight-bold">$
                                {{ $item->course->discount_price }} <span class="before-price font-weight-medium">$
                                    {{ $item->course->selling_price }}</span>
                            </p>
                        @endif


                        <div class="card-action-wrap pl-3">
                            <a href="course-details.html"
                                class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-success"
                                data-toggle="tooltip" data-placement="top" data-title="View"><i class="la la-eye"></i></a>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-secondary"
                                data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="la la-edit"></i>
                            </div>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-danger"
                                data-toggle="tooltip" data-placement="top" title="Delete">
                                <span data-toggle="modal" data-target="#itemDeleteModal"
                                    class="w-100 h-100 d-inline-block"><i class="la la-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        @empty
            <div class="card-body">
                <div class="alert alert-danger text-center">
                    <h5>Not Found.</h5>
                </div>
            </div>
        @endforelse


    </div><!-- end col-lg-12 -->


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
        <p class="fs-14 pt-2 mb-4">Showing 1-4 of 16 results</p>
    </div>
@endsection
