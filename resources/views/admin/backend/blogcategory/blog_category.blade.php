@extends('admin.admin_dashboard')

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        tbody td {
            text-align: center;
            vertical-align: middle;
        }

        .cursor {
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-category-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>

            {{-- button --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"
                        class="btn btn-primary tbl-custom"><i class="bx bx-plus"></i>Add
                        Blog Category</button>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="category" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $key => $item)
                                <tr>
                                    <td class="text-center" width="5%">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->category_name }}</td>
                                    <td class="text-center" width="20%">

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editCategory"
                                            class="btn btn-success px-1" id="{{ $item->id }}"
                                            onclick="categoryEdit(this.id)"><i class="bx bx-edit-alt"></i>Edit</button>

                                        <a href="{{ route('delete.category', $item->category_slug) }}"
                                            class="btn btn-danger px-1" id="delete"><i
                                                class="bx bx-trash-alt"></i>Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- add --}}
    <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.blog.category.store') }}" method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="category_name" class="form-label">Category Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    placeholder="Category Name">
                            </div>

                            <div class="col-md-12">
                                <label for="category_slug" class="form-label">Category Slug <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control cursor" id="category_slug" name="category_slug"
                                    placeholder="Category Slug" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Blog Category</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- edit --}}
    <div class="modal fade" id="editCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.blog.category.store') }}" method="post">
                    @csrf


                    <input type="hidden" name="id" id="id">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="category_name" class="form-label">Category Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cat_name" name="category_name"
                                    placeholder="Category Name">
                            </div>

                            <div class="col-md-12">
                                <label for="category_slug" class="form-label">Category Slug <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control cursor" id="cat_slug" name="category_slug"
                                    placeholder="Category Slug" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Blog Category</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category').DataTable({
                'sort': false,
            });
        });

        // slug
        const name = document.querySelector('#category_name');
        const slug = document.querySelector('#category_slug');

        name.addEventListener('change', function() {
            fetch('/blog/category/checkSlug?category_name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.category_slug)
        });

        // Mendapatkan referensi ke elemen modal
        const modal = document.getElementById('exampleVerticallycenteredModal'); // Ganti 'modalId' dengan ID modal Anda

        // Event listener untuk ketika modal tertutup
        modal.addEventListener('hidden.bs.modal', function() {
            // Mendapatkan referensi ke input nama dan slug
            const nameInput = document.querySelector('#category_name');
            const slugInput = document.querySelector('#category_slug');

            // Menghapus nilai input
            nameInput.value = '';
            slugInput.value = '';
        });

        // Event listener untuk ketika modal terbuka
        modal.addEventListener('shown.bs.modal', function() {
            // Mendapatkan referensi ke input nama kategori
            const nameInput = document.querySelector('#category_name');

            // Fokuskan pada input nama kategori
            nameInput.focus();
        });


        function categoryEdit(id) {
            $.ajax({
                type: "GET",
                url: "/admin/blog/category/edit/" + id,
                dataType: "json",
                success: function(data) {
                    // console.log(data); 
                    $('#cat_name').val(data.category_name);
                    $('#cat_slug').val(data.category_slug);
                    $('#id').val(data.id);
                }
            })
        }

        // slug
        const catname = document.querySelector('#cat_name');
        const catslug = document.querySelector('#cat_slug');

        catname.addEventListener('change', function() {
            fetch('/blog/category/checkSlug?category_name=' + catname.value)
                .then(response => response.json())
                .then(data => catslug.value = data.category_slug)
        });
    </script>

    @if ($errors->any())
        <script>
            // Mendefinisikan variabel untuk menyimpan pesan kesalahan
            var errorMessage = '';
            // Iterasi melalui setiap pesan kesalahan yang diterima dari validator
            @foreach ($errors->all() as $error)
                errorMessage += "{{ $error }}<br>";
            @endforeach

            // Menampilkan pesan kesalahan dalam SweetAlert
            Swal.fire(
                'Error!',
                errorMessage,
                'error'
            );
        </script>
    @endif
@endpush
