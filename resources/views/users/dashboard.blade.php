@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Portaal logins</h1>
            <div class="page-subtitle">Beheerspaneel</div>

            <div class="page-options d-flex">
                <a href="" class="btn shadow-sm btn-secondary mr-2">
                    <i class="fe fe-user-plus"></i>
                </a>

                <div class="btn-group">
                    <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe mr-2 fe-filter"></i> Filter
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('users.index') }}">Alle logins</a>
                        <a class="dropdown-item" href="{{ route('users.index', ['filter' => 'actief']) }}">Actieve logins</a>
                        <a class="dropdown-item" href="{{ route('users.index', ['filter' => 'gedeactiveerd']) }}">Non-actieve logins</a>
                        
                        @if ($currentUser->hasRole('webmaster')) {{-- Only webmasters are permitted to view the deleted users. Because the underlying functions --}}
                            <a class="dropdown-item" href="{{ route('users.index', ['filter' => 'verwijderd']) }}">Verwijderde logins</a>
                        @endif 
                    </div>
                </div>

                <form method="GET" action="" class="form-search ml-2">
                    <input type="text" class="form-control border-0 shadow-sm" @input('term') placeholder="Zoeken">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="card">
            <div class="table-responsive">
                <table class="table @if (count($users) > 0) table-hover @endif mb-0 card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naam</th>
                            <th scope="col">Status</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aangemaakt op</th>
                            <th scope="col">&nbsp;</th> {{-- Functies --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td><span class="text-muted table-id">#{{ $user->id }}</span></td>
                                <td>{{ $user->name }}</td>
                                
                                <td> {{-- Gebruikers status --}}
                                    @if ($user->trashed())
                                        <span class="badge badge-danger"><i class="fe fe-trash-2 mr-1"></i> Verwijderd</span>
                                    @else 
                                        <span class="badge badge-warning"><i class="fe fe-lock mr-1"></i> Gedeactiveerd</span>
                                    @endif
                                </td> {{-- /// Gebruikers status --}}

                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M, Y') }}</td>

                                <td> {{-- Functies met betrekking tot de gebruiker --}}
                                    <span class="float-right">
                                        @if (! $user->trashed())
                                            <a href="" class="text-decoration-none text-secondary mr-1">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            <a href="{{ route('users.lock', $user) }}" class="text-decoration-none @if ($currentUser->is($user)) disabled @endif text-secondary mr-1">
                                                <i class="fe fe-lock"></i>
                                            </a>
                                        @endif

                                        @if ($user->trashed()) 
                                            <a href="{{ route('users.delete.undo', $user)}}" class="text-decoration-none text-success">
                                                <i class="fe fe-rotate-ccw"></i>
                                            </a>
                                        @else {{-- The user is not deleted in the application. --}}
                                            <a href="{{ route('users.delete', $user) }}" class="text-decoration-none text-danger">
                                                <i class="fe fe-trash-2"></i>
                                            </a>
                                        @endif
                                    </span>
                                </td> {{-- /// Gebruiker functies --}}
                            </tr>     
                        @empty 
                            <tr>
                                <td class="table-no-results">
                                    <i class="icon fe fe-info mr-2"></i>
                                    Er zijn geen gebruikers gevonden met de matchende term of criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
@endsection