@extends ('layouts.app')

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Portaal logins</h1>
            <div class="page-subtitle">
                @if ($currentUser->can('same-user', $user)) 
                    Uw informatie instellingen
                @else {{-- Is not the authenticated user --}}
                    Informatie betreffende {{ ucfirst($user->name) }}
                @endif
            </div>

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
                <form method="POST" action="" class="card overrides card-body border-0 shadow-sm">
                    @csrf {{-- Form field protection --}}
                    @form($user) {{-- Bind user data to the form --}}
                    @method ('PATCH') {{-- HTTP method spoofing --}}

                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        @if ($currentUser->can('same-user', $user)) 
                            Uw informatie instellingen
                        @else {{-- Is not the authenticated user --}}
                            Informatie betreffende <strong>{{ ucfirst($user->name) }}</strong>
                        @endif
                    </h6>
                    
                    @include('flash::message') {{-- Flash session view partial --}}

                    @if ($user->isBanned())
                        <div class="alert alert-icon border-0 alert-important shadow-sm alert-danger" role="alert">
                            <i class="icon fe fe-alert-octagon" aria-hidden="true"></i> 
                            <strong>{{ $ban->createdBy->name }}</strong> heeft deze gebruiker gedeactiveerd wegens {{ $ban->comment }}
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="firstname">Voornaam @if ($currentUser->can('same-user', $user)) <span class="text-danger">*</span> @endif </label>
                            <input type="text" @input('firstname') class="form-control @error('firstname', 'is-invalid')" id="firstname" @if (! $currentUser->can('same-user', $user)) readonly @endif>
                            @error('firstname')
                        </div>

                        <div class="form-group col-6">
                            <label for="lastname">Achternaam @if ($currentUser->can('same-user', $user)) <span class="text-danger">*</span> @endif </label>
                            <input type="text" @input('lastname') class="form-control @error('lastname', 'is-invalid')" id="lastname" @if (! $currentUser->can('same-user', $user)) readonly @endif>
                            @error('lastname')
                        </div>

                        <div class="form-group @if (! $currentUser->can('same-user', $user)) mb-0 @endif col-6">
                            <label for="email">E-mail adres @if ($currentUser->can('same-user', $user)) <span class="text-danger">*</span> @endif </label>
                            <input type="email" @input('email') class="form-control @error('email', 'is-invalid')" id="email" @if (! $currentUser->can('same-user', $user)) readonly @endif>
                            @error('email')
                        </div>

                        <div class="form-group @if (! $currentUser->can('same-user', $user)) mb-0 @endif col-6">
                            <label for="phone_number">Tel. nummer @if ($currentUser->can('same-user', $user)) <span class="text-danger">*</span> @endif </label>
                            <input type="text" @input('phone_number') class="form-control @error('phone_number', 'is-invalid')" id="phone_number" @if (! $currentUser->can('same-user', $user)) readonly @endif>
                            @error('phone_number')
                        </div>
                    </div>

                    @if ($currentUser->can('same-user', $user))
                        <hr class="mt-0">

                        <div class="form-row">
                            <div class="form-group col-12 mb-0">
                                <button type="submit" class="btn shadow-sm btn-secondary">Wijzigen</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            <div class="col-md-3"> {{-- Sidenav --}}
                @include ('users.partials.sidebar', ['user' => $user])
            </div> {{-- /// END sidenav --}}
        </div>
    </div>
@endsection