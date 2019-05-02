@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Notificaties</h1>

            <div class="page-options d-flex">
                @php ($userNotifications = $currentUser->unreadNotifications()->count())

                <a href="{{ route('notifications.markAll') }}" class="btn @if ($userNotifications === 0) disabled @endif btn-secondary">
                    <span class="fe fe-bell-off mr-1"></span> Lees alles
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                @if (count($notifications) > 0) {{-- There are notifications found in the application --}}
                <div class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-2">
                        @if ($type === 'all')
                            Alle notificaties
                        @else
                            Ongelezen notificaties
                        @endif
                    </h6>

                    @foreach ($notifications as $notification)
                        <div class="media small text-muted pt-2">
                            <img src="{{ avatar($notification->notifiable) }}" alt="{{ $notification->notifiable->name }}" class="mr-2 shadow-sm notification-avatar rounded">
                            <div class="card w-100 card-text border-0 mb-0">
                                <div class="w-100">
                                    <strong class="float-left text-gray-dark mr-1">{{ $notification->data['title'] }}</strong> - {{ $notification->created_at->diffForHumans() }}</strong>
                                    @if ($notification->unread())
                                        <div class="float-right">
                                            <a href="" class="text-decoration-none"><i class="fe fe-check mr-1"></i>
                                                Markeer als gelezen
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{ $notification->data['body'] }}
                            </div>
                        </div>

                        @if (! $loop->last) {{-- This notification is not the latest so we need a breakline --}}
                        <hr class="mt-2 mb-0">
                        @endif
                    @endforeach

                    {{ $notifications->links() }} {{-- Paginator view instance --}}
                </div>
                @else {{-- There are no notifications found in the application --}}
                    <div class="notifications border-0 shadow-sm">
                        <h3><i class="fe text-secondary fe-bell mr-1"></i></h3>
                        <p class="pt-2">
                            @if ($type === 'all')
                                Momenteel hebben we geen notificaties voor jouw.
                            @else {{-- Unread notifications --}}
                                Er zijn geen ongelezen notificaties.
                            @endif
                        </p>
                    </div>
                @endif {{-- /// END notification loop --}}
            </div> {{-- /// END content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group list-group-transparent mb-4">
                    <a href="{{ route('notifications.index') }}" class="list-group-item {{ active(route('notifications.index', ['type' => null])) }} list-group-item-action">
                        <i class="fe fe-eye mr-3"></i> Ongelezen notificaties
                    </a>

                    <a href="{{ route('notifications.index', ['type' => 'all']) }}"
                       class="list-group-item {{ active(route('notifications.index', ['type' => 'all']))  }} list-group-item-action">
                        <i class="fe fe-list mr-3"></i> Alle notificaties
                    </a>
                </div>
            </div> {{-- /// END sidebar --}}
        </div>
    </div>
@endsection