@extends('frontend.dashboard.user_dashboard')

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
        <h3 class="fs-22 font-weight-semi-bold">Edit Profile</h3>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
            <div class="setting-body">
                <form action="{{ route('user.profile.update') }}" class="row pt-40px" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="media media-card align-items-center">
                        <div class="media-img media-img-lg mr-4 bg-gray">
                            <img class="mr-3"
                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                alt="avatar image">
                        </div>
                        <div class="media-body">
                            <div class="file-upload-wrap file-upload-wrap-2">
                                <input type="file" name="photo" class="multi file-upload-input with-preview">
                                <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                            </div><!-- file-upload-wrap -->
                            <p class="fs-14">Max file size is 5MB, Suitable files are jpg, png and jpeg</p>
                            @error('photo')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- end media -->

                    <div class="input-box col-lg-6 mt-3">
                        <label class="label-text">Name</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('name') is-invalid @enderror" type="text"
                                name="name" value="{{ $profileData->name }}">
                            <span class="la la-user input-icon"></span>
                            @error('name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-6 mt-3">
                        <label class="label-text">Username</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('username') is-invalid @enderror" type="text"
                                name="username" value="{{ $profileData->username }}">
                            <span class="la la-user input-icon"></span>
                            @error('username')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-6">
                        <label class="label-text">Phone</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('phone') is-invalid @enderror" type="text"
                                name="phone" value="{{ $profileData->phone }}">
                            <span class="la la-phone input-icon"></span>
                            @error('phone')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-6">
                        <label class="label-text">Email</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('email') is-invalid @enderror" type="email"
                                name="email" value="{{ $profileData->email }}">
                            <span class="la la-envelope input-icon"></span>
                            @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-12">
                        <label class="label-text">Address</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="address"
                                value="{{ $profileData->address }}">
                            <span class="las la-map-marker input-icon"></span>
                        </div>
                    </div><!-- end input-box -->


                    <div class="input-box col-lg-12 py-2">
                        <button type="submit" class="btn theme-btn">Save Changes</button>
                    </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->


        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="setting-body">
                <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
                <form method="post" class="row">
                    <div class="input-box col-lg-4">
                        <label class="label-text">Old Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text"
                                placeholder="Old Password">
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-4">
                        <label class="label-text">New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text"
                                placeholder="New Password">
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-4">
                        <label class="label-text">Confirm New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text"
                                placeholder="Confirm New Password">
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-12 py-2">
                        <button class="btn theme-btn">Change Password</button>
                    </div><!-- end input-box -->
                </form>
                <form method="post" class="pt-5 mt-5 border-top border-top-gray">
                    <h3 class="fs-17 font-weight-semi-bold pb-1">Forgot Password then Recover Password</h3>
                    <p class="pb-4">Enter the email of your account to reset password. Then you will receive a link to
                        email
                        to reset the password. If you have any issue about reset password
                        <a href="contact.html" class="text-color">contact us</a>
                    </p>
                    <div class="input-box">
                        <label class="label-text">Email Address</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="email" name="email"
                                placeholder="Enter email address">
                            <span class="la la-envelope input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box py-2">
                        <button class="btn theme-btn">Recover Password</button>
                    </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->

    </div><!-- end tab-content -->
@endsection
