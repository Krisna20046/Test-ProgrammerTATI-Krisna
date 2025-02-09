@extends('layouts.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- PDF Viewer -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Soal Test TATI</h6>
                </div>
                <div class="card-body">
                    <!-- Tempat untuk menampilkan PDF -->
                    <iframe id="pdf-viewer" width="100%" height="600px">
                        <p>Your browser does not support iframes.</p>
                    </iframe>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    // Mengatur sumber PDF menggunakan JavaScript
    document.getElementById('pdf-viewer').src = "{{ asset('pdf/tati.pdf') }}";
</script>
@endsection