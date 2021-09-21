<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Dashboard
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            {{ apply_filters('core::pages::dashboard::actions', '') }}
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row row-cards">
        {{ apply_filters('core::pages::dashboard::body', '') }}
    </div>
</div>
