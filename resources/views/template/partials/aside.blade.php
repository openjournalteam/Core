<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('core.home') }}">
                <img src="{{ asset('vendor/core/img/logo_ojt_hosting.png') }}" width="200" height="32" alt="OJT Hosting Logo" class="navbar-brand-image" style="height:2.3rem !important;">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            @livewire('core:notifications-dropdown', ['class' => 'nav-item d-none d-sm-flex me-3', 'notifications' =>
            $unreadNotifications])
            @livewire('core:user-dropdown', ['user'=> $user])
        </div>
        @livewire('core:menu:sidebar')
    </div>
</aside>
