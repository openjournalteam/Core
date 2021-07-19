<div class="flex-fill d-flex flex-column justify-content-center">
    <div class="container-tight py-6">
        <div class="text-center mb-4">
            <img src="{{ asset('vendor/core/img/logo.svg') }}" height="36" alt="">
        </div>
        <form class="card card-md ajax_form" action="{{ route('core.login.post') }}" method="POST">
            @csrf
            <div class="card-body">
                <h2 class="mb-5 text-center">Login to your account</h2>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" autocomplete="off"
                        required>
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input name="remember_me" type="checkbox" class="form-check-input">
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>
