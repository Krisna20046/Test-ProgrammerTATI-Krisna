@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Deret Bilangan Hello World</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Masukkan nilai N</label>
                        <input type="number" class="form-control" id="input_n" min="1" value="1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button class="btn btn-primary mt-4" onclick="generateSequence()">Generate Sequence</button>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Output
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sequence Result:</h5>
                            <p class="card-text" id="sequence_result"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Example Table -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Examples
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Function Call</th>
                                        <th>Output</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>helloworld(1)</td><td>1</td></tr>
                                    <tr><td>helloworld(2)</td><td>1 2</td></tr>
                                    <tr><td>helloworld(3)</td><td>1 2 3</td></tr>
                                    <tr><td>helloworld(4)</td><td>1 2 3 hello</td></tr>
                                    <tr><td>helloworld(5)</td><td>1 2 3 hello world</td></tr>
                                    <tr><td>helloworld(6)</td><td>1 2 3 hello world 6</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function helloworld(n) {
    let result = [];
    
    for (let i = 1; i <= n; i++) {
        if (i % 4 === 0 && i % 5 === 0) {
            result.push("helloworld");
        } else if (i % 4 === 0) {
            result.push("hello");
        } else if (i % 5 === 0) {
            result.push("world");
        } else {
            result.push(i.toString());
        }
    }
    
    return result.join(" ");
}

function generateSequence() {
    const n = parseInt(document.getElementById('input_n').value);
    if (n < 1) {
        alert("Please enter a positive number");
        return;
    }
    
    const result = helloworld(n);
    document.getElementById('sequence_result').innerText = result;
}

document.addEventListener('DOMContentLoaded', function() {
    generateSequence();
});
</script>
@endsection