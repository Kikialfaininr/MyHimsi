<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" href="{{ asset('image\logo himsi.png') }}" type="image">
    <!-- Font Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css\style-reset.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img alt="Himsi logo" height="50" src="{{ asset('image\logo himsi.png') }}" width="50" />
        </div>
        <h1>
            Reset your password
        </h1>
        <p>
            Masukkan alamat email Anda yang terdaftar di My Himsi untuk menerima informasi pengaturan ulang kata sandi
        </p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="btn btn-reset">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
        <div class="back-to-login">
            <a href="{{ route('login') }}">
                Back To Login
            </a>
        </div>
    </div>
</body>

</html>
