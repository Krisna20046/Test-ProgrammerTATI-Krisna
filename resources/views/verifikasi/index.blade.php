@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Log Harian</h1>
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
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Catatan Verifikasi</th>
                            <th class="text-center" style="width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $log->user->nama }}</td>
                            <td>{{ $log->role_nama }}</td>
                            <td>{{ $log->aktivitas }}</td>
                            <td>{{ $log->tanggal }}</td>
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
                                <button class="btn btn-primary btn-sm" onclick="verifikasiFunction('{{ $log->id }}', '{{ $log->status }}', '{{ $log->catatan_verifikasi }}', '{{ $log->aktivitas }}')">
                                    <i class="fas fa-check-circle"></i>
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

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="verifikasiForm">
                <div class="modal-body">
                    <input type="hidden" id="logId" name="logId">
                    <div class="form-group">
                        <label for="aktivitas">Aktivitas</label>
                        <textarea id="aktivitas" class="form-control" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Verifikasi</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="catatan_verifikasi">Catatan Verifikasi</label>
                        <textarea id="catatan_verifikasi" name="catatan_verifikasi" class="form-control" rows="3" required></textarea>
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

            $pagination.append(`
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `);

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    $pagination.append(`
                        <li class="page-item ${i === currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>
                    `);
                } else if (i === currentPage - 2 || i === currentPage + 2) {
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

        updateTable();
    });

    function verifikasiFunction(id, status, catatan, aktivitas) {
        $('#logId').val(id);
        $('#status').val(status);
        $('#catatan_verifikasi').val(catatan);
        $('#aktivitas').val(aktivitas);
        $('#verifikasiModal').modal('show');
    }

    $('#verifikasiForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#logId').val();
        let formData = new FormData(this);

        $.ajax({
            url: `/verifikasi/${id}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire('Sukses!', 'Verifikasi berhasil disimpan', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error!', 'Gagal menyimpan verifikasi', 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan sistem', 'error');
            }
        });
    });
</script>
@endsection