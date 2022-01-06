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
    {{-- <div class="row row-cards">
        @if ($widgets = \OpenJournalTeam\Core\Facades\Core::getWidgets())
        @foreach ($widgets as $widget)
        @livewire($widget::getName())
        @endforeach
        @endif
    </div> --}}

    @if ($widgetsGroup = \OpenJournalTeam\Core\Facades\Core::getWidgets())
    <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1 widgets" id="dashboard-widgets">
        <div class="widget-group">
            <div class="widget-container @if($widgetsGroup[1]->count() < 1) empty-container @endif"
                id="widget-container-1" data-column="1">
                @foreach ($widgetsGroup[1] as $widget)
                @livewire($widget::getName())
                @endforeach
            </div>
        </div>
        <div class="widget-group">
            <div class="widget-container @if($widgetsGroup[2]->count() < 1) empty-container @endif"
                id="widget-container-2" data-column="2">
                @foreach ($widgetsGroup[2] as $widget)
                @livewire($widget::getName())
                @endforeach
            </div>
        </div>
        <div class="widget-group">
            <div class="widget-container @if($widgetsGroup[3]->count() < 1) empty-container @endif"
                id="widget-container-3" data-column="3">
                @foreach ($widgetsGroup[3] as $widget)
                @livewire($widget::getName())
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

@section('scripts')
<script>
    var widget1 = document.getElementById("widget-container-1");
    var widget2 = document.getElementById("widget-container-2");
    var widget3 = document.getElementById("widget-container-3");
    var sortableOptions = {
      animation: 150,
      group: 'shared',
      draggable: '.widget',
      handle:  '.card-header',
      ghostClass: 'bg-azure-lt',
    onStart: function (evt) {
		$('.widget-container').addClass('widget-container-on-select')
        $('.widget-container .card-body').collapse('hide');
    },
    onEnd: function (evt){
        updateSort(this.toArray(), evt.from.dataset.column);
        
        $('.widget-container').removeClass('widget-container-on-select')
        $('.widget-container .card-body').collapse('show');
    },
    onChange: function (evt) {
        updateSort(this.toArray(), evt.to.dataset.column);
        $('#widget-container-1').children().length > 0 ? $('#widget-container-1').removeClass('empty-container') : $('#widget-container-1').addClass('empty-container');
        $('#widget-container-2').children().length > 0 ? $('#widget-container-2').removeClass('empty-container') : $('#widget-container-2').addClass('empty-container');
        $('#widget-container-3').children().length > 0 ? $('#widget-container-3').removeClass('empty-container') : $('#widget-container-3').addClass('empty-container');
    },
    };
    new Sortable(widget1, sortableOptions);
    new Sortable(widget2, sortableOptions);
    new Sortable(widget3, sortableOptions);


    function updateSort(list, column){
        if(list.length < 1) return false;
        return $.ajax({
            type: "POST",
            url: baseUrl + '/widget/update-setting',
            data: {
                classes: list,
                column: column
            },
        });
    }
</script>

@endsection