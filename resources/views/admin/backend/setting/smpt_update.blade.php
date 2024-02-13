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

                        <form method="POST" action="{{ route('admin.update.smpt') }}" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $smpt->id }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mailer" class="form-label">Mailer </label>
                                    <input type="text" class="form-control" name="mailer" id="mailer"
                                        value="{{ $smpt->mailer }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="host" class="form-label">Host</label>
                                    <input type="text" class="form-control" name="host" id="host"
                                        value="{{ $smpt->host }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="port" class="form-label">Port</label>
                                    <input type="number" class="form-control" name="port" id="port"
                                        value="{{ $smpt->port }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ $smpt->username }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password"
                                        value="{{ $smpt->password }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="encryption" class="form-label">Encryption</label>
                                    <input type="text" class="form-control" name="encryption" id="encryption"
                                        value="{{ $smpt->encryption }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="from_address" class="form-label">From Address</label>
                                    <input type="text" class="form-control" name="from_address" id="from_address"
                                        value="{{ $smpt->from_address }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox fs-15">
                                        <input type="checkbox" class="custom-control-input"
                                            {{ $smpt->status == 1 ? 'checked' : '' }} id="status" name="status">
                                        <label class="custom-control-label custom--control-label" for="status">&nbsp;
                                            Active</label>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                            class="bx bx-save"></i>Update SMPT</button>
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
@endpush
