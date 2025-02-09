@extends('layouts.head')

<body style="overflow:hidden; height:100vh; width:100vw;" class="bg-gradient-primary d-flex align-items-center justify-content-center">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePassword('password')">
                                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('register') }}">Create an Account!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                const data = await response.json();

                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.error || 'Invalid email or password!',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Login successful! Redirecting...',
                    }).then(() => {
                        window.location.href = "{{ route('dashboard') }}";
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                });
            }
        });
    </script>
</body>
