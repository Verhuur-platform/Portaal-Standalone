@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $tenant->full_name }}</h1>
            <div class="page-subtitle">Notities</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenant.notes.create', $tenant) }}" class="btn btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <div class="ml-2 btn-group">
                    <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe mr-2 fe-filter"></i> Filter
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('tenant.notes', $tenant) }}">Alle notities</a>
                        <a class="dropdown-item" href="{{ route('tenant.notes', ['tenant' => $tenant, 'filter' => 'auteur']) }}">Mijn notities</a>
                    </div>
                </div>

                <form method="GET" action="" class="form-search ml-2">
                    <input type="text" class="form-control border-0 shadow-sm" @input('term') placeholder="Zoeken">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-9"> {{-- Content --}}
                <div class="card">
                    <div class="table-responsive">
                        <table class="table mb-0 card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Auteur</th>
                                    <th scope="col">Titel</th>
                                    <th scope="col">Aangemaakt op</th>
                                    <th scope="col">&nbsp;</th> {{-- Column for the function only --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notes as $note)
                                    <tr>
                                        <td class="text-muted"><span class="table-id">{{ $note->author->name ?? 'Onbekend' }}</span></td>
                                        <td>{{ $note->titel }}</td>
                                        <td>{{ $note->created_at->format('d/m/Y') }}</td>


                                        <td> {{-- Options column  --}}
                                            <span class="float-right">
                                                <a href="{{ route('tenant.notes.show', $note) }}" class="text-decoration-none text-secondary mr-2">
                                                    <i class="fe fe-eye"></i>
                                                </a>

                                                <a href="{{ route('tenant.notes.edit', $note) }}" class="@if ($currentUser->cannot('update', $note)) disabled @endif text-decoration-none mr-1 text-secondary">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>

                                                <a href="{{ route('tenant.notes.delete', $note) }}" class="@if ($currentUser->cannot('delete', $note)) disabled @endif text-decoration-none text-danger">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            </span>
                                        </td> {{-- /// END options column --}}
                                    </tr>
                                @empty {{-- There are no notes for the tenant --}}
                                    <tr>
                                        <td colspan="4" class="table-no-results">
                                            <i class="icon fe fe-info mr-2"></i>
                                            Er zijn momenteel geen notities voor de huurder.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $notes->links() }} {{-- Pagination view partial --}}
                </div>
            </div> {{-- /// END content --}}

            <div class="col-3"> {{-- Side Navigation --}}
                @include ('tenants.partials.sidebar', ['tenant' => $tenant])
            </div> {{-- /// Side navigation --}}
        </div>
    </div>
@endsection