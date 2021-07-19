<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tabler Core -->
    <link href="{{ asset('vendor/core/css/tabler.min.css') }}" rel="stylesheet" />
    <!-- Tabler Plugins -->
    <link href="{{ asset('vendor/core/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/core/libs/swal/sweetalert2.min.css') }}" rel="stylesheet" />

    <style>
        body {
            display: none;
        }

    </style>
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
        <div class="container-tight py-6">
            <div class="text-center mb-4">
                <img src="{{ asset('vendor/core/img/logo.svg') }}" height="36" alt="">
            </div>
            <form class="card card-md ajax_form" action="{{ route('core.register.post') }}" method="POST">
                <div class="card-body">
                    <h2 class="mb-5 text-center">Create new account</h2>
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Already have account? <a href="./sign-in.html" tabindex="-1">Sign in</a>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('vendor/core/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/core/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/core/libs/jquery-form/jquery.form.min.js') }}"></script>
    <script src="{{ asset('vendor/core/libs/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/core/libs/swal/sweetalert2.min.js') }}"></script>


    <!-- Tabler Core -->
    <script src="{{ asset('vendor/core/js/tabler.min.js') }}"></script>
    <script src="{{ asset('vendor/core/js/form.js') }}"></script>
    <script src="{{ asset('vendor/core/js/swal.js') }}"></script>
    <script>
        document.body.style.display = "block"
    </script>
</body>

</html>
