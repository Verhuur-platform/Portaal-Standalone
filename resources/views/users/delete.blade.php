@extends ('layouts.app')

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Portaal logins</h1>
            <div class="page-subtitle">{{ $user->name }} verwijderen</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-9">
                <form method="POST" action="{{ route('users.delete', $user) }}" class="card card-body border-0 shadow-sm">
                    @csrf {{-- Form field protection --}}
                    @method ('DELETE') {{-- HTTP method spoofing --}}

                    <h6 class="border-bottom border-gray pb-1 mb-3">Login verwijderen van <strong>{{ $user->name }}</strong></h6>

                    <p class="card-text text-danger">
                        <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om de login van <strong>{{ $user->name }}</strong> te verwijderen.
                    </p>

                   <p class="card-text">
                        Bij het verwijderen van het gebruikers account voor <strong>{{ $user->name }}</strong> verhinderd u dat hij/zij zich nog kan inloggen in de applicatie. <br>
                        Plus ook zal al de data van het account verwijderd worden. Dus weer zeker of u de gebruiker wilt verwijderen en niet een toevallig misklik was. 
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-6">
                            <input type="password" placeholder="Uw wachtwoord ter bevestiging" class="form-control @error('confirmatie', 'is-invalid')" @input('confirmatie')>
                            @error('confirmatie')
                        </div>

                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn shadow-sm btn-danger">Verwijder</button>
                            <a href="{{ route('users.index') }}" class="btn shadow-sm btn-light">Annuleer</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-3"> {{-- Sidenav --}}
                <div class="list-group list-group-transparent">
                    <a href="" class="list-group-item list-group-item-action">
                        <i class="fe fe-info mr-3"></i> Account informatie
                    </a>
                    
                    <a href="" class="list-group-item list-group-item-action">
                        <i class="fe fe-list mr-3"></i> Activiteit audit 
                    </a>

                    <a href="" class="list-group-item list-group-item-action">
                        <i class="fe fe-lock mr-3"></i> Deactiveer login
                    </a> 

                    <a href="{{ route('users.delete', $user) }}" class="list-group-item list-group-item-action {{ active('users.delete') }}">
                        <i class="fe fe-trash-2 mr-3"></i> Verwijder account
                    </a>
                </div>
            </div> {{-- /// END sidenav --}}
        </div>
    </div>
@endsection