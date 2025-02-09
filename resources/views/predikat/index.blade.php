@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Predikat Kinerja</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hasil Kerja</label>
                        <select class="form-control" id="hasil_kerja">
                            <option value="diatas ekspektasi">Diatas Ekspektasi</option>
                            <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
                            <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Perilaku</label>
                        <select class="form-control" id="perilaku">
                            <option value="diatas ekspektasi">Diatas Ekspektasi</option>
                            <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
                            <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" onclick="hitungPredikat()">Hitung Predikat</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4>Hasil Predikat: <span id="hasil_predikat" class="font-weight-bold"></span></h4>
                </div>
            </div>

            <!-- Matrix Table -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hasil Kerja \ Perilaku</th>
                                <th>Dibawah Ekspektasi</th>
                                <th>Sesuai Ekspektasi</th>
                                <th>Diatas Ekspektasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Diatas Ekspektasi</td>
                                <td>Kurang</td>
                                <td>Baik</td>
                                <td>Sangat Baik</td>
                            </tr>
                            <tr>
                                <td>Sesuai Ekspektasi</td>
                                <td>Kurang</td>
                                <td>Baik</td>
                                <td>Baik</td>
                            </tr>
                            <tr>
                                <td>Dibawah Ekspektasi</td>
                                <td>Sangat Kurang</td>
                                <td>Butuh Perbaikan</td>
                                <td>Butuh Perbaikan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function predikat_kinerja(hasil_kerja, perilaku) {

    const matrix = {
        'diatas ekspektasi': {
            'diatas ekspektasi': 'Sangat Baik',
            'sesuai ekspektasi': 'Baik',
            'dibawah ekspektasi': 'Kurang'
        },
        'sesuai ekspektasi': {
            'diatas ekspektasi': 'Baik',
            'sesuai ekspektasi': 'Baik',
            'dibawah ekspektasi': 'Kurang'
        },
        'dibawah ekspektasi': {
            'diatas ekspektasi': 'Butuh Perbaikan',
            'sesuai ekspektasi': 'Butuh Perbaikan',
            'dibawah ekspektasi': 'Sangat Kurang'
        }
    };
    
    return matrix[hasil_kerja.toLowerCase()][perilaku.toLowerCase()];
}

function hitungPredikat() {
    const hasil_kerja = document.getElementById('hasil_kerja').value;
    const perilaku = document.getElementById('perilaku').value;
    const hasil = predikat_kinerja(hasil_kerja, perilaku);
    
    document.getElementById('hasil_predikat').innerText = hasil;
}
</script>
@endsection