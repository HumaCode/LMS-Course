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

    <div class="row" id="wishlist">


    </div>

    <div class="text-center py-3" id="paginate">


    </div>
@endsection
