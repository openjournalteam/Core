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
        <div class="collapse navbar-collapse" id="navbar-menu">
            @php
                $currentRouteName = Route::currentRouteName();
            @endphp
            @inject('MenuManager', \OpenJournalTeam\Core\Classes\MenuManager::class)

            <ul class="navbar-nav pt-lg-3">
                @foreach ($MenuManager->list() as $menu)
                    @if (array_key_exists('role', $menu) && $menu['role'])
                        @unlessrole($menu['role'])
                        @continue
                        @endunlessrole
                    @endif
                    @if (array_key_exists('submenus', $menu))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                                aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    @if (isset($menu['icon']))
                                        {!! $menu['icon'] !!}
                                    @endif
                                </span>
                                <span class="nav-link-title">
                                    {{ $menu['title'] }}
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        @foreach ($menu['submenus'] as $submenu)
                                            @if (array_key_exists('role', $submenu) && $submenu['role'])
                                                @unlessrole($submenu['role'])
                                                @continue
                                                @endunlessrole
                                            @endif
                                            @php
                                                $isActive = $submenu['route'] == $currentRouteName ? 'active' : false;
                                            @endphp
                                            <a class="dropdown-item {{ $isActive }}"
                                                href="{{ array_key_exists('route', $submenu) && $submenu['route'] != false ? route($submenu['route']) : '#' }}">
                                                {{ $submenu['title'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        @php
                            $isActive = array_key_exists('route', $menu) && $menu['route'] == $currentRouteName ? 'active' : false;
                        @endphp
                        <li class="nav-item {{ $isActive }}">
                            <a class="nav-link"
                                href="{{ array_key_exists('route', $menu) && $menu['route'] != false ? route($menu['route']) : '#' }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    @if (isset($menu['icon']))
                                        {!! $menu['icon'] !!}
                                    @endif
                                </span>
                                <span class="nav-link-title">
                                    {{ $menu['title'] }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="mt-auto">
                <ul class="navbar-nav">
                    {{ apply_filters('Panelbackend::template::partials::aside::ul', false) }}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('core.logout') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
