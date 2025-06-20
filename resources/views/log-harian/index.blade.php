@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Log Harian</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#logModal" onclick="openLogModal()">
            <i class="fas fa-plus mr-2"></i>Tambah Log
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
                        <input type="text" class="form-control" id="searchLog" placeholder="Search...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="logTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 80px">No</th>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Catatan Verifikasi</th>
                            <th class="text-center" style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $log->aktivitas }}</td>
                            <td>{{ date('d/m/Y', strtotime($log->tanggal)) }}</td>
                            <td>
                                @if($log->status == 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($log->status == 'Disetujui')
                                    <span class="badge badge-success">Disetujui</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $log->catatan_verifikasi }}</td>
                            <td class="text-center">
                                @if($log->status != 'Disetujui')
                                    <button class="btn btn-warning btn-sm" onclick="editFunction('{{ $log->id }}', '{{ $log->aktivitas }}', '{{ $log->tanggal }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteFunction('{{ $log->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
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

<!-- Modal Tambah/Edit Log -->
<div class="modal fade" id="logModal" tabindex="-1" log="dialog" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog" log="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logModalLabel">Tambah Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="logForm">
                <div class="modal-body">
                    <input type="hidden" id="logId">
                    <div class="form-group">
                        <label for="aktivitas">Aktivitas</label>
                        <textarea id="aktivitas" name="aktivitas" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" required>
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
        let tableRows = $('#logTable tbody tr');
        let totalEntries = tableRows.length;

        function updateTable() {
            let searchTerm = $('#searchLog').val().toLowerCase();
            let filteredRows = tableRows.filter(function() {
                let rowText = $(this).find('td').map(function() {
                    return $(this).text().toLowerCase();
                }).get().join(' ');
                
                return rowText.includes(searchTerm);
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
        $('#searchLog').on('input', function() {
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

    function openLogModal() {
        document.getElementById('logForm').reset();
        document.getElementById('logId').value = '';
        document.getElementById('logModalLabel').textContent = 'Tambah Log';
        $('#logModal').modal('show');
    }

    function editFunction(id, aktivitas, tanggal) {
        document.getElementById('logId').value = id;
        document.getElementById('aktivitas').value = aktivitas;
        document.getElementById('tanggal').value = tanggal;
        document.getElementById('logModalLabel').textContent = 'Edit Log';
        $('#logModal').modal('show');
    }

    $('#logForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#logId').val();
        let url = id ? `/log-harian/${id}` : '/log-harian';
        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire('Sukses!', data.success, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error!', data.error.nama[0], 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
            }
        });
    });

    function deleteFunction(id) {
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
                fetch(`/log-harian/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
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