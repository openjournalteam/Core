<div>
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          Settings
        </div>
        <h2 class="page-title">
          Menu
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="card-body">
        <ul class="list-group sortable-menu" id="menu-list" url="#">
          @foreach (Core::getNavigation(false) as $menu)
          <li class="list-group-item" data-id="{{ $menu->getLabel() }}">
            <div class="d-flex">
              <div class="d-flex align-items-center me-1">
                <i class="bi {{ $menu->getEnabled() ? 'bi-check text-success' : 'bi-x text-danger' }}"
                  style="font-size:1.3em" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="{{ $menu->getEnabled() ? 'Menu Show' : 'Menu Hidden' }}"></i>
                <span>
                  @if ($menu->getIcon())
                  {!! $menu->getIcon() !!}
                  @endif
                  {{ $menu->getLabel() }}
                </span>
                @if($subMenus = $menu->getSubNavigationItems())
                <div class="widget-collapse collapsed ms-1" data-bs-toggle="collapse"
                  data-bs-target="#a{{ Str::snake($menu->getLabel()) }}" aria-expanded="false" wire:ignore.self>
                  <i class="bi bi-caret-up-fill"></i>
                </div>
                @endif
              </div>

              <div class="ms-auto d-flex align-items-center">
                <a class="{{ $menu->getEnabled() ? 'text-warning' : 'text-success' }}" href="#"
                  wire:click="toggleMenu('{{ $menu->getLabel() }}')">
                  @if($menu->getEnabled())
                  <i class="bi bi-eye-slash"></i>
                  Hide
                  @else
                  <i class="bi bi-eye-fill"></i>
                  Show
                  @endif
                </a>
                @if($menu->getPermission())
                <a href="#" class="ms-3" data-bs-toggle="modal"
                  wire:click="$set('permissionName', '{{ $menu->getPermission() }}')"
                  data-bs-target="#modal-menu-permission">
                  <i class="bi bi-person-check-fill"></i> Permission
                </a>
                @endif
              </div>
            </div>
            @if($subMenus)
            <ul class="list-group mt-2 collapse" id="a{{ Str::snake($menu->getLabel()) }}" wire:ignore.self>
              @foreach ($subMenus as $subMenu)
              <li class="list-group-item">
                <div class="d-flex">
                  <div class="d-flex align-items-center me-1">
                    <i class="bi {{ $subMenu->getEnabled() ? 'bi-check text-success' : 'bi-x text-danger' }}"
                      style="font-size:1.3em" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="{{ $subMenu->getEnabled() ? 'Menu Show' : 'Menu Hidden' }}"></i>
                    <span>
                      @if ($subMenu->getIcon())
                      {!! $subMenu->getIcon() !!}
                      @endif
                      {{ $subMenu->getLabel() }}
                    </span>
                  </div>

                  <div class="ms-auto d-flex align-items-center">
                    <a class="{{ $subMenu->getEnabled() ? 'text-warning' : 'text-success' }}" href="#"
                      wire:click="toggleMenu('{{ $subMenu->getLabel() }}')">
                      @if($subMenu->getEnabled())
                      <i class="bi bi-eye-slash"></i>
                      Hide
                      @else
                      <i class="bi bi-eye-fill"></i>
                      Show
                      @endif
                    </a>
                    @if($subMenu->getPermission())
                    <a href="#" class="ms-3" data-bs-toggle="modal"
                      wire:click="$set('permissionName', '{{ $subMenu->getPermission() }}')"
                      data-bs-target="#modal-menu-permission">
                      <i class="bi bi-person-check-fill"></i> Permission
                    </a>
                    @endif
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-menu-permission" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Menu Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @if($permissionName)
        <div class="table-responsive">
          <table class="table table-vcenter">
            <thead>
              <tr>
                <th>#</th>
                <th>Role</th>
                <th>Access</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $key => $role)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $role->name }}</td>
                <td>
                  <label class="form-check form-switch" wire:click="togglePermission('{{ $role->id }}')">
                    <input class="form-check-input" type="checkbox"
                      @if($role->checkPermissionTo($permissionName))checked @endif>
                  </label>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
        <div class="modal-footer">
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


@section('scripts')
<script>
  new Sortable(document.getElementById("menu-list"), {
    animation: 150,
    ghostClass: 'active',
    // chosenClass: "bg-secondary",
    onUpdate: function (evt) {
      let list = this.toArray();
      @this.updateSort(list);
    },
  });
</script>
@endsection