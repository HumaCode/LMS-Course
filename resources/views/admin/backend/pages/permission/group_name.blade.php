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
                        Group Name</button>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="g_name" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($groupName as $key => $item)
                                <tr>
                                    <td class="text-center" width="5%">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->g_name }}</td>
                                    <td class="text-center" width="20%">

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editGroupName"
                                            class="btn btn-success px-1" id="{{ $item->id }}"
                                            onclick="groupName(this.id)"><i class="bx bx-edit-alt"></i>Edit</button>

                                        <a href="{{ route('admin.delete.group_name', $item->id) }}"
                                            class="btn btn-danger px-1" id="delete"><i
                                                class="bx bx-trash-alt"></i>Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th>Sl</th>
                                <th>Group Name</th>
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
                    <h5 class="modal-title">Add Group Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.store.group_name') }}" method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="g_name" class="form-label">Group Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="g_name2" name="g_name"
                                    placeholder="Group Name">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Group Name</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- edit --}}
    <div class="modal fade" id="editGroupName" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Group Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.update.group_name') }}" method="post">
                    @csrf


                    <input type="hidden" name="id" id="id">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="g_name" class="form-label">Group Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="group_name" name="g_name"
                                    placeholder="Group Name">
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Group Name</button>
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
            $('#g_name').DataTable({
                'sort': false,
            });
        });


        // Mendapatkan referensi ke elemen modal
        const modal = document.getElementById('exampleVerticallycenteredModal'); // Ganti 'modalId' dengan ID modal Anda

        // Event listener untuk ketika modal tertutup
        modal.addEventListener('hidden.bs.modal', function() {
            // Mendapatkan referensi ke input nama dan slug
            const nameInput = document.querySelector('#g_name2');

            // Menghapus nilai input
            nameInput.value = '';
        });

        // Event listener untuk ketika modal terbuka
        modal.addEventListener('shown.bs.modal', function() {
            // Mendapatkan referensi ke input nama kategori
            const nameInput = document.querySelector('#g_name2');

            // Fokuskan pada input nama kategori
            nameInput.focus();
        });


        function groupName(id) {
            $.ajax({
                type: "GET",
                url: "/admin/group_name/edit/" + id,
                dataType: "json",
                success: function(data) {
                    // console.log(data); 
                    $('#group_name').val(data.g_name);
                    $('#id').val(data.id);
                }
            })
        }
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
