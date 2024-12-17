<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon/mw.png') }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/auth.css') }}">

</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row">
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                                class="img-fluid" alt="Sample image"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;">
                        </div>
            <div class="col-lg-6 mt-5">
                <div class="form-container mt-5">
                    <div class="text-center mb-4 mt-5">
                        <h1 class="mb-0" style="font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                            <span class="text-primary">Si</span><span class="text-dark fw-bold">Absensi</span>
                        </h1>
                        <h5 class="mb-1 text-muted" style="font-size: 16px; margin-bottom: 5px;">Login</h5>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="username" autofocus>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if (Route::has('password.request'))
                            <a class="d-block mt-2 text-right text-secondary" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-CZwr4zVuM9vMpcJCCGjzBCDVPtLarLkZMg/yD2j2MR5J1Y4U3QCzqYwTCtJlSGI/" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-+0n0xVW2eSR5Lqk5KA7w5fjMouJwMmwZym0kqjv0r6h7Z1KS7xfovrFNYuw3hwpH" crossorigin="anonymous">
        </script>
</body>

</html>