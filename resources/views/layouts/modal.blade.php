<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white;">
                <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="text-center mb-4">
                    <img class="img-profile rounded-circle shadow" src="img/undraw_profile.svg" width="120" height="120" alt="Profile Picture" style="border: 3px solid #007bff;">
                    <h4 class="mt-2 font-weight-bold" style="color: #333;">{{ Auth::user()->nama }}</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profileEmail" class="font-weight-bold" style="color: #555;">Email</label>
                            <input type="email" class="form-control-plaintext" id="profileEmail" value="{{ Auth::user()->email }}" readonly style="color: #333;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profileCreated" class="font-weight-bold" style="color: #555;">Bergabung Sejak</label>
                            <input type="text" class="form-control-plaintext" id="profileCreated" value="{{ Auth::user()->created_at->format('d M Y') }}" readonly style="color: #333;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profileRole" class="font-weight-bold" style="color: #555;">Role</label>
                            <input type="text" class="form-control-plaintext" id="profileRole" value="{{ Auth::user()->role ? Auth::user()->role->role_name : 'User' }}" readonly style="color: #333;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profileAtasan" class="font-weight-bold" style="color: #555;">Atasan</label>
                            <input type="text" class="form-control-plaintext" id="profileAtasan" value="{{ Auth::user()->atasan ? Auth::user()->atasan->nama : '-' }}" readonly style="color: #333;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 10px; border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; border-color: #6c757d;">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>