@extends('admin.admin_dashboard')

@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Change Password</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div> --}}


        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                        alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    <div class="mt-3">
                                        <h4>{{ $profileData->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $profileData->username }}</p>
                                        <p class="text-muted font-size-sm">{{ $profileData->email }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">

                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf

                            <div class="card pt-4">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Old Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="old_password"
                                                    class="form-control border-end-0 @error('old_password') is-invalid @enderror"
                                                    id="password" placeholder="Old Password"> <a href="javascript:;"
                                                    class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                            </div>


                                            @error('old_password')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">New Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <div class="input-group" id="show_hide_password2">
                                                <input type="password" name="new_password"
                                                    class="form-control border-end-0 @error('new_password') is-invalid @enderror"
                                                    id="password" placeholder="New Password"> <a href="javascript:;"
                                                    class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                            </div>


                                            @error('new_password')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Confirm Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <div class="input-group" id="show_hide_password3">
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control border-end-0 @error('new_password_confirmation') is-invalid @enderror"
                                                    id="password" placeholder="Confirm New Password"> <a
                                                    href="javascript:;" class="input-group-text bg-transparent"><i
                                                        class="bx bx-hide"></i></a>
                                            </div>


                                            @error('new_password_confirmation')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });

            $("#show_hide_password2 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password2 input').attr("type") == "text") {
                    $('#show_hide_password2 input').attr('type', 'password');
                    $('#show_hide_password2 i').addClass("bx-hide");
                    $('#show_hide_password2 i').removeClass("bx-show");
                } else if ($('#show_hide_password2 input').attr("type") == "password") {
                    $('#show_hide_password2 input').attr('type', 'text');
                    $('#show_hide_password2 i').removeClass("bx-hide");
                    $('#show_hide_password2 i').addClass("bx-show");
                }
            });

            $("#show_hide_password3 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password3 input').attr("type") == "text") {
                    $('#show_hide_password3 input').attr('type', 'password');
                    $('#show_hide_password3 i').addClass("bx-hide");
                    $('#show_hide_password3 i').removeClass("bx-show");
                } else if ($('#show_hide_password3 input').attr("type") == "password") {
                    $('#show_hide_password3 input').attr('type', 'text');
                    $('#show_hide_password3 i').removeClass("bx-hide");
                    $('#show_hide_password3 i').addClass("bx-show");
                }
            });
        });
    </script>
@endpush
