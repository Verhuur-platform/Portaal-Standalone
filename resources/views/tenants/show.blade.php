@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $tenant->full_name }}</h1>
            <div class="page-subtitle">Algemene informatie</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.dashboard') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="{{ route('tenants.update', $tenant)  }}" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">Algemene informatie van <strong>{{ $tenant->full_name }}</strong></h6>
                    @csrf {{-- Form field protection --}}
                    @form($tenant) {{-- Bind data to the form --}}
                    @method('PATCH') {{-- HTTP method spoofing --}}

                    @include ('flash::message') {{-- Flash session view partial --}}

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="voornaam">Voornaam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('firstname', 'is-invalid')" placeholder="Voornaam" @input('firstname')>
                            @error('firstname')
                        </div>

                        <div class="form-group col-6">
                            <label for="achternaam">Achternaam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lastname', 'is-invalid')" placeholder="Achternaam" @input('lastname')>
                            @error('lastname')
                        </div>

                        <div class="form-group col-6">
                            <label for="email">E-mail adres <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email', 'is-invalid')" placeholder="E-mail adres" @input('email')>
                            @error('email')
                        </div>

                        <div class="form-group col-6">
                            <label for="telNr">Telefoon nr <span class="text-danger">*</span></label>
                            <input type="text" id="telNr" class="form-control @error('tel_nr', 'is-invalid')" placeholder="Telefoon nummer" @input('tel_nr')>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-secondary shadow-sm">Aanpassen</button>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}

            <div class="col-3"> {{-- Sidebar --}}
                @include('tenants.partials.sidebar', ['tenant' => $tenant])
            </div> {{-- /// END sidebar --}}
        </div>
    </div>
@endsection