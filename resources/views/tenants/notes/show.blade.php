@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $note->notable->full_name }}</h1>
            <div class="page-subtitle">Weergave notitie</div>

            <div class="page-options d-flex">
                <div class="btn-group shadow-sm">
                    <a href="{{ route('tenant.notes', $note->notable) }}" class="btn btn-secondary">
                        <i class="fe fe-list mr-2"></i> Notities
                    </a>
                    <a href="{{ route('tenants.dashboard') }}" class="btn btn-secondary">
                        <i class="fe fe-users mr-2"></i> Huurders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-9"> {{-- Content --}}
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-2">[notitie]: {{ ucfirst($note->titel) }}</h6>
                    <span class="small mb-2">Aangemaakt door {{ $note->author->name }} op {{ $note->created_at->format('d/m/Y') }}</span>
                
                    <p class="card-text">{{ ucfirst($note->content) }}</p>

                    @if ($currentUser->can('update', $note) || $currentUser->can('delete', $note))
                        <hr class="mt-0">

                        <p class="card-text">
                            @if ($currentUser->can('update', $note)) {{-- Authenticateduser is authorized to update the note --}}
                                <a href="{{ route('tenant.notes.edit', $note) }}" class="card-link text-decoration-none text-secondary">
                                    <i class="fe fe-edit-2 mr-1"></i> Wijzig
                                </a>
                            @endif

                            @if ($currentUser->can('delete', $note)) {{-- Authenticated user is authorized to delete the note --}}
                                <a href="" class="card-link text-decoration-none text-danger">
                                    <i class="fe fe-trash-2 mr-1"></i> Verwijder
                                </a>
                            @endif
                        </p>
                    @endif
                </div>
            </div> {{-- /// End content --}}
                
            <div class="col-3"> {{-- Sidebar --}}
            </div> {{-- /// END sidebar --}}
        </div>
    </div>
@endsection