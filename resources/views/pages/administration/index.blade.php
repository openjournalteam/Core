<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="page-pretitle">
                Administration
            </div>
            <h2 class="page-title">
                Tools
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            {{ apply_filters('core::pages::administration::actions', '') }}
        </div>
    </div>
</div>
<div class="page-body">
    @if (Session::has('message'))
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </div>
                <div>
                    {{ Session::get('message') }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Administrative Functions</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('core.admin.administrator.clear_cache') }}">Clear Cache</a>
            {{ apply_filters('core::pages::administration::card-body', '') }}
        </div>
    </div>
</div>
