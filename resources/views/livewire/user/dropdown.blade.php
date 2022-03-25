<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
        <span class="avatar avatar-sm">{{ substr($user->name, 0, 1) }}</span>
        <div class="d-none d-lg-block ps-2">
            <div>{{ $user->name }}</div>
            <div class="mt-1 small text-muted">{{ $user->email }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a href="{{ route('core.profile.index') }}" class="dropdown-item">Profile &amp; account</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">Settings</a>
        <a href="{{ route('core.logout') }}" class=" dropdown-item">Logout</a>
    </div>
</div>
