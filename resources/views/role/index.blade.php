@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#roleModal" onclick="openRoleModal()">
            <i class="fas fa-plus mr-2"></i>Tambah Role
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 d-flex align-items-center">
                    <label class="mr-2 mb-0">Show</label>
                    <select class="form-control form-control-sm w-auto" id="entriesPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="ml-2 mb-0">entries</label>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="searchRole" placeholder="Search...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="roleTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 80px">No</th>
                            <th>Nama Role</th>
                            <th class="text-center" style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $role->role_name }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" onclick="editRole('{{ $role->id }}', '{{ $role->role_name }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRole('{{ $role->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="text-muted">Showing <span id="startEntry">1</span> to <span id="endEntry">10</span> of <span id="totalEntries">0</span> entries</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end" id="pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Role -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="roleForm">
                <div class="modal-body">
                    <input type="hidden" id="roleId">
                    <div class="form-group">
                        <label for="role_name">Nama Role</label>
                        <input type="text" id="role_name" name="role_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let entriesPerPage = 10;
    let tableRows = $('#roleTable tbody tr');
    let totalEntries = tableRows.length;

    function updateTable() {
        let searchTerm = $('#searchRole').val().toLowerCase();
        let filteredRows = tableRows.filter(function() {
            let text = $(this).text().toLowerCase();
            return text.indexOf(searchTerm) > -1;
        });

        let startIndex = (currentPage - 1) * entriesPerPage;
        let endIndex = startIndex + entriesPerPage;
        
        tableRows.hide();
        filteredRows.slice(startIndex, endIndex).show();

        updatePagination(filteredRows.length);
        updateEntryInfo(startIndex + 1, Math.min(endIndex, filteredRows.length), filteredRows.length);
    }

    function updatePagination(filteredTotal) {
        let totalPages = Math.ceil(filteredTotal / entriesPerPage);
        let $pagination = $('#pagination');
        $pagination.empty();

        // Previous button
        $pagination.append(`
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage - 1}">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (
                i === 1 || 
                i === totalPages || 
                (i >= currentPage - 1 && i <= currentPage + 1)
            ) {
                $pagination.append(`
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `);
            } else if (
                i === currentPage - 2 || 
                i === currentPage + 2
            ) {
                $pagination.append(`
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                `);
            }
        }

        // Next button
        $pagination.append(`
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage + 1}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        `);
    }

    function updateEntryInfo(start, end, total) {
        $('#startEntry').text(total === 0 ? 0 : start);
        $('#endEntry').text(end);
        $('#totalEntries').text(total);
    }

    // Event Listeners
    $('#searchRole').on('input', function() {
        currentPage = 1;
        updateTable();
    });

    $('#entriesPerPage').on('change', function() {
        entriesPerPage = parseInt($(this).val());
        currentPage = 1;
        updateTable();
    });

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        if (page && !$(this).parent().hasClass('disabled')) {
            currentPage = page;
            updateTable();
        }
    });

    // Initial table setup
    updateTable();
});

    function openRoleModal() {
        document.getElementById('roleForm').reset();
        document.getElementById('roleId').value = '';
        document.getElementById('roleModalLabel').textContent = 'Tambah Role';
        $('#roleModal').modal('show');
    }

    function editRole(id, roleName) {
        document.getElementById('roleId').value = id;
        document.getElementById('role_name').value = roleName;
        document.getElementById('roleModalLabel').textContent = 'Edit Role';
        $('#roleModal').modal('show');
    }

    $('#roleForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#roleId').val();
        let url = id ? `/role/${id}` : '/role';
        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire('Sukses!', data.success, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error!', data.error.role_name[0], 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
            }
        });
    });

    function deleteRole(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/role/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Deleted!', data.success, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                })
                .catch(() => Swal.fire('Error!', 'Terjadi kesalahan.', 'error'));
            }
        });
    }
</script>
@endsection