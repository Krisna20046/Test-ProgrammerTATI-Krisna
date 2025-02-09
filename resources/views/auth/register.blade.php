@extends('layouts.head')

<body style="overflow:hidden; height:100vh; width:100vw;" class="bg-gradient-primary d-flex align-items-center justify-content-center">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control form-control-user" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address" required>
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
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @extends('layouts.js')
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

        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password must be at least 8 characters!',
                });
                return;
            }

            if (password !== passwordConfirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and confirmation password do not match!',
                });
                return;
            }

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
                    if (response.status === 422) {
                        const errorMessage = Object.values(data.error).flat().join('\n');
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMessage,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Registration successful!',
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
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