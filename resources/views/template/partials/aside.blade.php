<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('core.home') }}">
                <img src="{{ asset('vendor/core/img/logo-white.svg') }}" width="110" height="32"
                    alt="OpenJournalTeam Panel" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
        </div>
        @livewire('core:menu:sidebar')
    </div>
</aside>
