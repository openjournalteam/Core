<div>
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col d-flex align-items-center">
        <h2 class="page-title">
          Dashboard
        </h2>
        <div wire:loading class="spinner-border spinner-border-sm text-primary ms-2">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <button class="btn btn-outline-primary" wire:click="toggleCustomize()" wire:loading.attr="disabled">
          @if(!$customize)
          <i class="bi bi-pen me-2"></i> Customize
          @else
          <i class="bi bi-check2 me-2"></i> Done
          @endif
        </button>
      </div>
    </div>
  </div>
  <div class="page-body">
    @if ($widgetGroup)
    <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1 widgets" id="dashboard-widgets">
      <div class="widget-group">
        <div class="widget-container @if(count($widgetGroup[1]) < 1) empty-container @endif" id="widget-container-1"
          data-column="1">
          @foreach ($widgetGroup[1] as $widget)
          <x-core::widget-container :widget="$widget" :customize="$customize" />
          @endforeach
        </div>
      </div>
      <div class="widget-group">
        <div class="widget-container @if(count($widgetGroup[2]) < 1) empty-container @endif" id="widget-container-2"
          data-column="2">
          @foreach ($widgetGroup[2] as $widget)
          <x-core::widget-container :widget="$widget" :customize="$customize" />
          @endforeach
        </div>
      </div>
      <div class="widget-group">
        <div class="widget-container @if(count($widgetGroup[3]) < 1) empty-container @endif" id="widget-container-3"
          data-column="3">
          @foreach ($widgetGroup[3] as $widget)
          <x-core::widget-container :widget="$widget" :customize="$customize" />
          @endforeach
        </div>
      </div>
    </div>
    @endif
  </div>
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
    dragClass: 'bg-azure-lt',
    onStart: function (evt) {
        $('.widget-container').addClass('widget-container-on-select')
        $('.widget-container .widget-body').collapse('hide');
    },
    onEnd: function (evt){
        $('.widget-container').removeClass('widget-container-on-select')
        $('.widget-container .widget-body').collapse('show');
    },
    onChange: function (evt) {
        $('#widget-container-1').children().length > 0 ? $('#widget-container-1').removeClass('empty-container') : $('#widget-container-1').addClass('empty-container');
        $('#widget-container-2').children().length > 0 ? $('#widget-container-2').removeClass('empty-container') : $('#widget-container-2').addClass('empty-container');
        $('#widget-container-3').children().length > 0 ? $('#widget-container-3').removeClass('empty-container') : $('#widget-container-3').addClass('empty-container');
    },
    onSort: function (evt) {
        let currentColumn = this.el.dataset.column;
        let data = this.toArray();
        if(data.length > 0) @this.updateSortWidget(data, currentColumn);
    }
  };
  new Sortable(widget1, sortableOptions);
  new Sortable(widget2, sortableOptions);
  new Sortable(widget3, sortableOptions);
</script>

@endsection