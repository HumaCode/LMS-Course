@extends('admin.admin_dashboard')

@push('css')
@endpush

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-plus"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.category') }}" class="btn btn-danger tbl-custom"><i
                            class="bx bx-left-arrow-alt"></i>Back</a>
                </div>
            </div> --}}

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="row">
            <div class="col-xl-12 mx-auto">

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">{{ $title }}</h5>

                        <form method="POST" action="{{ route('admin.site.update') }}" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $site->id }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" value="{{ $site->phone }}">
                                    @error('phone')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ $site->email }}">
                                    @error('email')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" id="address" value="{{ $site->address }}">
                                    @error('address')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook"
                                        value="{{ $site->facebook }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter"
                                        value="{{ $site->twitter }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="copyright" class="form-label">Copyright</label>
                                    <input type="text" class="form-control @error('copyright') is-invalid @enderror"
                                        name="copyright" id="copyright" value="{{ $site->copyright }}">
                                    @error('copyright')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="logo" class="form-label">Logo <span class="text-danger">*</span></label>
                                    <input class="form-control @error('logo') is-invalid @enderror" type="file"
                                        name="logo" id="logo" accept=".jpg,.jpeg,.png">
                                    @error('logo')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <img id="showImage" src="{{ asset($site->logo) }}" alt="Logo" class="p-1 bg-primary"
                                    width="20%"> <br>
                                <span class="text-danger">* Max file size is 2MB, Suitable files are jpg, png and
                                    jpeg.</span>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update SITE</button>
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
        // image picker
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endpush
