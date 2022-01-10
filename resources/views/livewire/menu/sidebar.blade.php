<div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav pt-lg-3">
        @foreach (\OpenJournalTeam\Core\Facades\Core::getNavigation() as $nav)
        @if(($nav->getPermission() === null) || user()->can($nav->getPermission()))
        <li class="nav-item @if($subNavs = $nav->getSubNavigationItems()) dropdown @endif">
            <a class="nav-link @if($subNavs) dropdown-toggle @endif" href="{{ $nav->getRoute(true) }}" @if($subNavs)
                data-bs-toggle="dropdown" @endif role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block">
                    {!! $nav->getIcon() !!}
                </span>
                {{ $nav->getLabel()}}
            </a>
            @if($subNavs)
            <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                        @foreach ($subNavs as $subNav)
                        @if(!$subNav->getEnabled()) @continue @endif
                        @if($subNav->getPermission() === null || user()->can($nav->getPermission()))
                        <a class="dropdown-item" href="{{ $subNav->getRoute(true) }}">
                            <span class="nav-link-icon d-inline-block">
                                {!! $subNav->getIcon() !!}
                            </span>
                            {{ $subNav->getLabel()}}
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </li>
        @endif
        @endforeach
    </ul>
    <div class="mt-auto">
        <ul class="navbar-nav">
            {{ apply_filters('core::template::partials::aside::ul', false) }}
            <li class="nav-item">
                <a class="nav-link">
                    <span class="nav-link-icon d-inline-block">
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