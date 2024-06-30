<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Drive | {{ $title }}</title>

    {{-- my css --}}
    <link rel="stylesheet" href="{{ asset('register/register.css') }}">

</head>

<body>

    <div class="my-container shadow-lg">
        <div class="login-content d-flex justify-content-center">
            <form class="form" action="/registrasi" method="post">
                @csrf
                <h2 class="title">{{ $title }}</h2>
                <div class="input-content">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="input-content">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="input-content">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="input-content">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">Register</button>
                    <p>
                        Have an account? <a href="/auth">Login here</a>
                    </p>
                </div>
            </form>
        </div>
        <div class="image-content">
            <img src="{{ asset('images/login/register.jpg') }}" alt="">
        </div>
    </div>

</body>

</html>
