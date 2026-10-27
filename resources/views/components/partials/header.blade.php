<header class="bg-base-100 border-b border-base-300 h-16 flex items-center px-6 gap-4 sticky top-0 z-30 shadow-sm">

    <button onclick="toggleSidebar()" class="btn btn-square btn-ghost lg:hidden">
        <i data-lucide="menu" class="w-5 h-5"></i>
    </button>

    <div class="flex-1">
        <div class="flex items-center gap-2 text-sm">
            <span class="text-base-content/50">Poliklinik</span>
            <i data-lucide="chevron-right" class="w-4 h-4 text-base-content/30"></i>
            <span class="font-semibold text-base-content">
                {{ $title ?? 'Dashboard' }}
            </span>
        </div>
    </div>

    <button onclick="toggleFullscreen()" class="btn btn-square btn-ghost">
        <i id="fsIcon" class="fas fa-expand w-5 h-5"></i>
    </button>

    <div class="flex items-center gap-3">
        @php
            $unreadNotificationCount = auth()->user()->unreadNotifications()->count();
            $latestNotifications = auth()->user()->notifications()->latest()->limit(10)->get();
        @endphp

        <details class="dropdown dropdown-end">
            <summary
                class="btn btn-square btn-ghost relative list-none"
                aria-label="Notifikasi{{ $unreadNotificationCount ? ', belum dibaca: ' . $unreadNotificationCount : '' }}">
                <i class="fas fa-bell"></i>
                @if($unreadNotificationCount > 0)
                    <span class="badge badge-error badge-xs absolute -right-1 -top-1 text-white">
                        {{ $unreadNotificationCount > 99 ? '99+' : $unreadNotificationCount }}
                    </span>
                @endif
            </summary>

            <div class="dropdown-content z-[60] mt-3 max-h-96 w-80 max-w-[calc(100vw-2rem)] overflow-x-hidden overflow-y-auto rounded-xl border border-base-300 bg-base-100 shadow-xl">
                <div class="border-b border-base-200 px-4 py-3">
                    <h2 class="text-sm font-semibold">Notifikasi</h2>
                </div>

                @forelse($latestNotifications as $notification)
                    <div class="flex items-start gap-3 border-b border-base-200 px-4 py-3 last:border-b-0 {{ $notification->read_at ? 'bg-base-100' : 'bg-primary/5' }}">
                        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full {{ $notification->read_at ? 'bg-base-300' : 'bg-primary' }}"></span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm {{ $notification->read_at ? 'font-medium' : 'font-semibold' }}">
                                {{ $notification->data['title'] ?? 'Notifikasi baru' }}
                            </p>
                            <p class="mt-0.5 text-xs leading-relaxed text-base-content/70">
                                {{ $notification->data['message'] ?? 'Anda memiliki notifikasi baru.' }}
                            </p>
                            <time class="mt-1 block text-[11px] text-base-content/50" datetime="{{ $notification->created_at->toIso8601String() }}">
                                {{ $notification->created_at->diffForHumans() }}
                            </time>
                        </div>

                        @unless($notification->read_at)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-ghost btn-xs text-primary">Baca</button>
                            </form>
                        @endunless
                    </div>
                @empty
                    <p class="px-4 py-8 text-center text-sm text-base-content/60">Belum ada notifikasi.</p>
                @endforelse
            </div>
        </details>

        <div class="text-right hidden sm:block">
            <div class="text-sm font-semibold leading-tight">
                {{ auth()->user()->nama ?? 'Pengguna' }}
            </div>
            <div class="text-xs text-base-content/50 leading-tight capitalize">
                {{ auth()->user()->role ?? 'User' }}
            </div>
        </div>

        <div class="avatar">
            <div class="w-10 h-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                <span class="text-sm font-semibold leading-none">
                    {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                </span>
            </div>
        </div>
    </div>

</header>

<script>
    function toggleFullscreen() {
        const icon = document.getElementById('fsIcon');

        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
            icon.classList.remove('fa-expand');
            icon.classList.add('fa-compress');
        } else {
            document.exitFullscreen();
            icon.classList.remove('fa-compress');
            icon.classList.add('fa-expand');
        }
    }
</script>