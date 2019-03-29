@extends ('layouts.app')

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Portaal logins</h1>
            <div class="page-subtitle">Account instellingen</div>

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
                <form method="POST" action="" class="card card-body border-0 shadow-sm">
                    @csrf {{-- Form field protection --}}
                    @method ('PATCH') {{-- HTTP method spoofing --}}

                    <h6 class="border-bottom border-gray pb-1 mb-3">Uw beveiligings instellingen</strong></h6>
                    @include('flash::message') {{-- Flash session view partial --}}

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputConfirmatie">Huidig wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" placeholder="Uw huidig wachtwoord" id="inputConfirmatie" @input('huidig_wachtwoord') class="form-control @error('huidig_wachtwoord', 'is-invalid')">
                            @error('huidig_wachtwoord')
                        </div>

                        <div class="form-group col-6">
                            <label for="inputWachtwoord">Nieuw wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" placeholder="Uw nieuw wachtwoord" id="inputWachtwoord" class="form-control @error('wachtwoord', 'is-invalid')" @input('wachtwoord')>
                            @error('wachtwoord')
                        </div>

                        <div class="form-group col-6">
                            <label for="wachtwoordBevestiging">Bevestig wachtwoord <span class="text-danger">*</span></label>
                            <input type="password", placeholder="Herhaal uw nieuw wachtwoord" id="wachtwoordBevestiging" class="form-control @error('wachtwoord_conformation', 'is-invalid')" @error('wachtwoord_confirmation')>
                            @error('wachtwoord_confirmation')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn shadow-sm btn-secondary">Wijzigen</button>
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