@extends('layouts.index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Provinsi API Testing</h1>
    </div>

    <!-- GET All Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">GET /api/provinsi</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" onclick="getProvinsi()">Send Request</button>
            <div class="mt-3">
                <label class="font-weight-bold">Response:</label>
                <pre id="getResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Click 'Send Request' to see response</pre>
            </div>
        </div>
    </div>

    <!-- POST Sync Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">POST /api/provinsi/sync</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" onclick="syncProvinsi()">Send Request</button>
            <div class="mt-3">
                <label class="font-weight-bold">Response:</label>
                <pre id="syncResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Click 'Send Request' to see response</pre>
            </div>
        </div>
    </div>

    <!-- POST Create Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">POST /api/provinsi</h6>
        </div>
        <div class="card-body">
            <form id="createForm" onsubmit="createProvinsi(event)">
                <div class="form-group">
                    <label for="createName">Name:</label>
                    <input type="text" class="form-control" id="createName" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Send Request</button>
            </form>
            <div class="mt-3">
                <label class="font-weight-bold">Request Headers:</label>
                <pre class="bg-light p-3 rounded">Content-Type: application/x-www-form-urlencoded</pre>
                <label class="font-weight-bold">Response:</label>
                <pre id="createResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Send request to see response</pre>
            </div>
        </div>
    </div>

    <!-- GET Detail Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">GET /api/provinsi/{code}</h6>
        </div>
        <div class="card-body">
            <form id="detailForm" onsubmit="getProvinsiDetail(event)">
                <div class="form-group">
                    <label for="detailCode">Code:</label>
                    <input type="text" class="form-control" id="detailCode" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Send Request</button>
            </form>
            <div class="mt-3">
                <label class="font-weight-bold">Response:</label>
                <pre id="detailResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Send request to see response</pre>
            </div>
        </div>
    </div>

    <!-- PUT Update Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PUT /api/provinsi/{code}</h6>
        </div>
        <div class="card-body">
            <form id="updateForm" onsubmit="updateProvinsi(event)">
                <div class="form-group">
                    <label for="updateCode">Code:</label>
                    <input type="text" class="form-control" id="updateCode" required>
                </div>
                <div class="form-group">
                    <label for="updateName">Name:</label>
                    <input type="text" class="form-control" id="updateName" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Send Request</button>
            </form>
            <div class="mt-3">
                <label class="font-weight-bold">Request Headers:</label>
                <pre class="bg-light p-3 rounded">Content-Type: application/x-www-form-urlencoded</pre>
                <label class="font-weight-bold">Response:</label>
                <pre id="updateResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Send request to see response</pre>
            </div>
        </div>
    </div>

    <!-- DELETE Provinsi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DELETE /api/provinsi/{code}</h6>
        </div>
        <div class="card-body">
            <form id="deleteForm" onsubmit="deleteProvinsi(event)">
                <div class="form-group">
                    <label for="deleteCode">Code:</label>
                    <input type="text" class="form-control" id="deleteCode" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Send Request</button>
            </form>
            <div class="mt-3">
                <label class="font-weight-bold">Response:</label>
                <pre id="deleteResponse" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">Send request to see response</pre>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function formatResponse(data) {
        return JSON.stringify(data, null, 2);
    }

    function getProvinsi() {
        $.ajax({
            url: '/api/provinsi',
            type: 'GET',
            success: function(response) {
                $('#getResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#getResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }

    function syncProvinsi() {
        $.ajax({
            url: '/api/provinsi/sync',
            type: 'POST',
            success: function(response) {
                $('#syncResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#syncResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }

    function createProvinsi(e) {
        e.preventDefault();
        $.ajax({
            url: '/api/provinsi',
            type: 'POST',
            data: {
                name: $('#createName').val()
            },
            success: function(response) {
                $('#createResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#createResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }

    function getProvinsiDetail(e) {
        e.preventDefault();
        const code = $('#detailCode').val();
        $.ajax({
            url: `/api/provinsi/${code}`,
            type: 'GET',
            success: function(response) {
                $('#detailResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#detailResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }

    function updateProvinsi(e) {
        e.preventDefault();
        const code = $('#updateCode').val();
        $.ajax({
            url: `/api/provinsi/${code}`,
            type: 'PUT',
            data: {
                name: $('#updateName').val()
            },
            success: function(response) {
                $('#updateResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#updateResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }

    function deleteProvinsi(e) {
        e.preventDefault();
        const code = $('#deleteCode').val();
        $.ajax({
            url: `/api/provinsi/${code}`,
            type: 'DELETE',
            success: function(response) {
                $('#deleteResponse').text(formatResponse(response));
            },
            error: function(xhr) {
                $('#deleteResponse').text(formatResponse(xhr.responseJSON));
            }
        });
    }
</script>
@endsection