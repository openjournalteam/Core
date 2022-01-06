<div class="card widget @if(!$widget::getEnabled()) bg-dark-lt @endif" data-id="{{ $widget }}">
  {{-- <div class="card-header" data-bs-toggle="collapse" data-bs-target="#{{ $id }}"> --}}
    <div class="card-header">
      <div class="">
        <h3 class="card-title">{{ $widget::getTitle() }}</h3>
      </div>
      <div class="card-toolbar">
        @if($customize)
        <label class="form-check form-check-single form-switch">
          <input class="form-check-input" type="checkbox" wire:click='toggleWidget(@json($widget))'
            @if($widget::getEnabled()) checked @endif>
        </label>
        @endif
      </div>
    </div>
    <div class="widget-body collapse show" id="{{ $id }}">
      @livewire($widget::getName(), key($widget::getName()))
    </div>
  </div>