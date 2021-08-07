<nav class="navbar d-none d-lg-flex navbar-light bg-light">
    <div class="container-fluid">
        <div></div>
        <div></div>
        <div class="navbar-nav flex-row">
            @livewire('core:notifications-dropdown', ['class' => 'nav-item d-none d-sm-flex me-3', 'notifications' =>
            $unreadNotifications])
            @livewire('core:user-dropdown', ['user'=> $user])
        </div>
    </div>
</nav>
