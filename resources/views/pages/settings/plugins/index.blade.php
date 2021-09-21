    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Settings
                </div>
                <h2 class="page-title">
                    Plugins
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                {{ apply_filters('core::pages::settings::plugins::actions', false) }}
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="card-tabs">
            <!-- Cards navigation -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#tab-borderless-1" class="nav-link active p-3" data-bs-toggle="tab">Installed Plugins</a>
                </li>
                <li class="nav-item">
                    <a href="#tab-borderless-2" class="nav-link p-3" data-bs-toggle="tab">Plugin Gallery</a>
                </li>
                {{ apply_filters('core::pages::settings::plugins::nav-tabs', false) }}
            </ul>
            <div class="tab-content">
                <!-- Content of card #1 -->
                <div id="tab-borderless-1" class="card tab-pane active show">
                    <div class="list-group card-list-group">
                        @foreach ($plugins as $plugin)
                            @php
                                $attributes = $plugin->json()->getAttributes();
                            @endphp
                            <div id="plugin{{ $attributes['name'] }}"
                                x-data="plugin('{{ $attributes['name'] }}',{{ $plugin->isEnabled() ? 'true' : 'false' }})"
                                class="list-group-item">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto mr-3">
                                        <a href="#" class="pointer" @@click="toggleOpen">
                                            <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'rotate-r-90' : ''"
                                                class="transition transform" width="15" height="15" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="5" y1="12" x2="19" y2="12" />
                                                <line x1="15" y1="16" x2="19" y2="12" />
                                                <line x1="15" y1="8" x2="19" y2="12" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col">
                                        {{ $attributes['name'] }}
                                        <div class="text-muted">
                                            {{ $attributes['description'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-check form-switch form-switch-lg">
                                            <input class="form-check-input" type="checkbox" x-model="enabled" readonly>
                                        </label>
                                    </div>
                                </div>
                                <div x-show="open" class="plugin_option mt-2 row">
                                    <div class="col-auto">
                                        <a href="#" @@click="deletePlugin" class="text-danger">Delete</a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" @@click="migratePlugin" class="">Migrate</a>
                                    </div>
                                    {{ apply_filters('core::pages::settings::plugins::option::' . $attributes['name'], false) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- Content of card #2 -->
                <div id="tab-borderless-2" class="card tab-pane">
                    <div class="empty">
                        <img src="{{ asset('vendor/core/img/illustration/undraw_joyride_hnno.svg') }}"
                            style="max-height: 50vh">
                        <h1 class="empty-title">Coming Soon</h1>
                    </div>
                </div>
                {{ apply_filters('core::pages::settings::plugins::tab-content', false) }}
            </div>
        </div>
    </div>
