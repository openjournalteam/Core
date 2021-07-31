<div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav pt-lg-3">
        @foreach ($menus as $menu)
            @hasanyrole($menu->roles())
            @php
                $hasChilds = $menu->childs->count() > 0 ? true : false;
                $route = $menu->route ? route($menu->route) : '#';
            @endphp
            <li class="nav-item {{ $hasChilds ? 'dropdown' : '' }}">
                <a class="nav-link {{ $hasChilds ? 'dropdown-toggle' : '' }}" href="{{ $hasChilds ? '#' : $route }}"
                    {{ $hasChilds ? 'data-bs-toggle=dropdown' : '' }} role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        @if (isset($menu->icon))
                            {!! $menu->icon !!}
                        @endif
                    </span>
                    <span class="nav-link-title">
                        {{ $menu->name }}
                    </span>
                </a>
                @if ($hasChilds)
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @foreach ($menu->childs as $sub)
                                    <a class="dropdown-item" href="{{ route($sub->route) }}">
                                        @if (isset($sub->icon))
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                {!! $sub->icon !!}
                                            </span>
                                        @endif
                                        {{ $sub->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </li>
            @endhasanyrole

        @endforeach


        @foreach ($hookMenu as $hm)

            <li class="nav-item">
                <a class="nav-link" href="{{ route($hm['route']) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! $hm['icon'] !!}
                    </span>
                    {{ $hm['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="mt-auto">
        <ul class="navbar-nav">
            {{ apply_filters('core::template::partials::aside::ul', false) }}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('core.logout') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
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
