<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Drive | {{ $title }}</title>

    {{-- my css --}}
    <link rel="stylesheet" href="{{ asset('login/login.css') }}">

    {{-- sweet alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>

    <div class="container">
        <div class="image-content">
            <img src="{{ asset('images/login/login.jpg') }}" alt="">
        </div>
        <div class="login-content">
            <form class="form" action="/auth" method="post">
                @csrf
                <h1 class="title">Login</h1>
                <div class="content-form">
                    <div class="input-content">
                        <label for="email">Email</label>
                        <input type="email" name="email"
                            class="form-control email @error('email') is-invalid @enderror" required
                            value="{{ old('email') }}">
                        <p class="alert">your email is incorrect! please make sure your email is correctly</p>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-content">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                            class="form-control password @error('password') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn-submit">Login</button>
                    <p>
                        Don't have an account? <a href="/registrasi">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    {{-- my js --}}
    <script src="{{ asset('login/login.js') }}"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    {{-- Initialize sweet alert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    @endif

    @if (session('loginError'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Error!',
                text: '{{ session('loginError') }}',
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
        </script>
    @endif
</body>

</html>
