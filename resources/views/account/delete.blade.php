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
                        <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om je login op <strong>{{ config('app.name') }} - Verhuur portaal</strong> te verwijderen.
                    </p>

                   <p class="card-text">
                        Bij het verwijderen van uw account verhinderd u dat je je nog kan inloggen in de applicatie. <br>
                        Plus ook zal al de data van het account verwijderd worden na 2 weken. Dus weer zeker of u de gebruiker wilt verwijderen en niet een toevallig misklik was. 
                    </p>

                    <p class="card-text">
                        Alsook houden we je data nog 2 weken bij voor het geval dit een vergissing was of u wilt terugkeren naar de applicatie.
                    </P>

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
                @include ('users.partials.sidebar', ['user' => $user])
            </div> {{-- /// END sidenav --}}
        </div>
    </div>
@endsection