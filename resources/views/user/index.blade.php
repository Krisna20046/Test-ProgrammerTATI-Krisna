@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#userModal" onclick="openUserModal()">
            <i class="fas fa-plus mr-2"></i>Tambah User
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
                        <input type="text" class="form-control" id="searchUser" placeholder="Search...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="userTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 80px">No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Atasan</th>
                            <th>Role</th>
                            <th class="text-center" style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->atasan->nama ?? '-' }}</td>
                            <td>{{ $user->role->role_name ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" onclick="editUser('{{ $user->id }}', '{{ $user->nama }}', '{{ $user->email }}', '{{ $user->atasan_id }}', '{{ $user->role_id }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser('{{ $user->id }}')">
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

<!-- Modal Tambah/Edit User -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="userForm">
                <div class="modal-body">
                    <input type="hidden" id="userId" name="id">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-user" placeholder="Repeat Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password_confirmation')">
                                        <i class="fa fa-eye" id="togglePasswordConfirmationIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="atasan_id">Atasan</label>
                        <select id="atasan_id" name="atasan_id" class="form-control">
                            <option value="">Pilih Atasan</option>
                            @foreach($atasan as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select id="role_id" name="role_id" class="form-control" required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
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
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const icon = document.getElementById(`toggle${inputId.charAt(0).toUpperCase() + inputId.slice(1)}Icon`);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
$(document).ready(function() {
    let currentPage = 1;
    let entriesPerPage = 10;
    let tableRows = $('#userTable tbody tr');
    let totalEntries = tableRows.length;

    function updateTable() {
        let searchTerm = $('#searchUser').val().toLowerCase();
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

        $pagination.append(`
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage - 1}">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `);

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

    $('#searchUser').on('input', function() {
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

    updateTable();
});

function openUserModal() {
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('userModalLabel').textContent = 'Tambah User';
    $('#userModal').modal('show');
}

function editUser(id, nama, email, atasan_id, role_id) {
    document.getElementById('userId').value = id;
    document.getElementById('nama').value = nama;
    document.getElementById('email').value = email;
    document.getElementById('atasan_id').value = atasan_id;
    document.getElementById('role_id').value = role_id;
    document.getElementById('userModalLabel').textContent = 'Edit User';
    $('#userModal').modal('show');
}

$('#userForm').on('submit', function(e) {
    e.preventDefault();
    let id = $('#userId').val();
    let url = id ? `/user/${id}` : '/user';
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
                Swal.fire('Error!', data.error, 'error');
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = Object.values(errors).flat().join('\n');
            Swal.fire('Error!', errorMessage, 'error');
        }
    });
});

function deleteUser(id) {
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
            fetch(`/user/${id}`, {
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