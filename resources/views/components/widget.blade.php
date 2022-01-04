<div class="card mb-3 widget" data-id="{{ $this::class }}">
  <div class="card-header" data-bs-toggle="collapse" data-bs-target="#a{{ $id = Str::lower(Str::random()) }}">
    <h3 class="card-title">{{ $title }}</h3>
    <div class="card-toolbar">
      {{ $actions ?? '' }}
    </div>
  </div>
  <div class="card-body collapse show" id="a{{ $id }}">
    {{ $slot }}
  </div>
</div>