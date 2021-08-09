<div class="dropdown {{ $class }}">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
            </path>
            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
        </svg>
        @if ($notifications->count() > 0)
            <span class="badge bg-red"></span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-arrow" wire:ignore style="width:400px">
        <div class="card">
            <div class="card-header text-center" style="padding: 8px 12px;">
                <h3 class="card-title">Notifications</h3>
            </div>
            <div class="card-body p-0">
                @forelse ($notifications as $notification)
                    @if (!array_key_exists('message', $notification->data))
                        @continue
                    @endif
                    <div class="dropdown-item" wire:click="markAsRead('{{ $notification->id }}')">
                        <div class="notification">
                            <div class="message text-wrap">
                                {!! $notification->data['message'] !!}
                            </div>
                            <small>
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @empty
                    <div class="dropdown-item">
                        No notifications
                    </div>
                @endforelse
            </div>
            <div class="card-footer p-0">
                <a href="#" class="dropdown-item">
                    See all notifications
                </a>
            </div>
        </div>
    </div>
</div>
