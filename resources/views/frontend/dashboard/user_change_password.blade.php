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
        <div class="tab-pane fade " id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
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


        <div class="tab-pane fade show active" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="setting-body">
                <form method="post" class="row" action="{{ route('user.password.update') }}">
                    @csrf


                    <div class="input-box col-lg-4">
                        <label class="label-text">Old Password</label>
                        <div class="input-group ">

                            <span class="la la-lock input-icon"></span>
                            <input
                                class="form-control form--control password-field @error('old_password') is-invalid @enderror"
                                type="password" name="old_password" placeholder="Old Password">
                            <div class="input-group-append">
                                <button class="btn theme-btn theme-btn-transparent toggle-password custom-pass3"
                                    type="button">
                                    <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                                    </svg>
                                    <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                            fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('old_password')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-4">
                        <label class="label-text">New Password</label>
                        <div class="input-group ">

                            <span class="la la-lock input-icon"></span>
                            <input
                                class="form-control form--control custom-pass2 @error('new_password') is-invalid @enderror"
                                type="password" name="new_password" placeholder="New Password">
                            <div class="input-group-append">
                                <button class="btn theme-btn theme-btn-transparent toggle-password custom-pass"
                                    type="button">
                                    <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                                    </svg>
                                    <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                            fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('new_password')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-4">
                        <label class="label-text">Password Confirmation</label>
                        <div class="input-group ">

                            <span class="la la-lock input-icon"></span>
                            <input
                                class="form-control form--control custom-pass-pass @error('new_password_confirmation') is-invalid @enderror"
                                type="password" name="new_password_confirmation" placeholder="Password Confirmation">
                            <div class="input-group-append">
                                <button class="btn theme-btn theme-btn-transparent toggle-password custom-pass4"
                                    type="button">
                                    <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                                    </svg>
                                    <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                        viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                            fill="none" />
                                        <path
                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('new_password_confirmation')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div><!-- end input-box -->


                    <div class="input-box col-lg-12 py-2 mt-3">
                        <button type="submit" class="btn theme-btn">Change Password</button>
                    </div><!-- end input-box -->
                </form>

                <div class="section-block mb-5 mt-3"></div>


                <h3 class="fs-17 font-weight-semi-bold pb-1">Forgot Password then Recover Password</h3>
                <p class="pb-4">Enter the email of your account to reset password. Then you will receive a link to
                    email
                    to reset the password. If you have any issue about reset password
                    <a href="contact.html" class="text-color">contact us</a>
                </p>

            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->

    </div><!-- end tab-content -->
@endsection
