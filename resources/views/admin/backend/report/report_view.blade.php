@extends('admin.admin_dashboard')

@push('css')
    <style>
        .cst {
            background: aliceblue;
            cursor: no-drop;
        }
    </style>
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
                    <a href="{{ route('admin.all.coupon') }}" class="btn btn-danger tbl-custom"><i
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


                        <div class="row">
                            <div class="col-md-4">
                                <form id="myForm" method="POST" action="{{ route('admin.search.by.date') }}"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group">
                                        <label for="date" class="form-label">Search By Date </label>
                                        <input type="date" class="form-control" name="date" id="date"
                                            placeholder="Date">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                                    class="bx bx-save"></i>Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <form id="myForm" method="POST" action="{{ route('admin.search.by.month') }}"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group">
                                        <label for="month" class="form-label">Search By Month </label>

                                        <select name="month" id="month" class="form-control">
                                            <option selected disabled>Select month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="Jun">Jun</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="year_name" class="form-label">Search By Year </label>

                                        <select name="year_name" id="year_name" class="form-control">
                                            <option value="">Select Year</option>

                                            @for ($i = 2023; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                                    class="bx bx-save"></i>Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <form id="myForm" method="POST" action="{{ route('admin.search.by.year') }}"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group">
                                        <label for="year" class="form-label">Search By Year </label>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">Select Year</option>

                                            @for ($i = 2023; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4 tbl-custom"><i
                                                    class="bx bx-save"></i>Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('script')
@endpush
