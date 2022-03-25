<div class="container">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Profile
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="row gx-lg-5">
            <div class="d-none d-lg-block col-lg-3">
                <ul class="nav nav-pills nav-vertical" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tab-preferences" class="nav-link active" data-bs-toggle="tab">
                            Preferences
                        </a>
                        <a href="#tab-authentication" class="nav-link" data-bs-toggle="tab">
                            Authentication
                        </a>
                        <a href="#tab-api-token" class="nav-link" data-bs-toggle="tab">
                            API Tokens
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-preferences">
                        <div class="card">
                            <div class="empty">
                                <div class="empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user-exclamation" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <line x1="19" y1="7" x2="19" y2="10"></line>
                                        <line x1="19" y1="14" x2="19" y2="14.01"></line>
                                    </svg>
                                </div>
                                <p class="empty-title">Oops.</p>
                                <p class="empty-subtitle text-muted">
                                    Coming Soon
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-authentication">
                        @livewire('core:profile.authentication')
                    </div>
                    <div class="tab-pane" id="tab-api-token">
                        @livewire('core:profile.api-token')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
