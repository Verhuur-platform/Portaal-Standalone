@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Logins</h1>
            <div class="page-subtitle">Nieuws login toevoegen</div>

            <div class="page-options d-flex">
                <a href="{ route('users.index') }}" class="btn btn-shadow btn-secondary mr-2">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form method="POST" action="{{ route('users.store') }}" class="card card-body border-0 shadow-sm">
            @csrf {{-- Form field protection --}}
            <h6 class="border-bottom border-gray pb-1 mb-3">Login toevoegen</h6>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="voornaam">Voornaam <span class="text-danger">*</span></label>
                    <input type="text" placeholder="Voornaam" id="Voornaam" class="form-control @error('firstname', 'is-invalid')" @input('firstname')>
                    @error('firstname')
                </div>
                
                <div class="form-group col-6">
                    <label for="achternaam">Achternaam <span class="text-danger">*</span></label>
                    <input type="text" placeholder="Achternaam" id="achternaam" class="form-control @error('lastname', 'is-invalid')" @input('lastname')>
                    @error('lastname')
                </div>

                <div class="form-group col-6">
                    <label for="email">E-mail adres <span class="text-danger">*</span></label>
                    <input type="email" placeholder="E-mail adres" id="email" class="form-control @error('email', 'is-invalid')" @input('email')>
                    @error('email')
                </div>

                <div class="form-group col-3"   >
                    <label for="telNr">Tel. nummer</label>
                    <input type="text" placeholder="Telefoon nr" id="telNr" class="form-control @error('phone_number', 'is-invalid')" @input('phone_number')>
                    @error('phone_nummer')
                </div>

                <div class="form-group col-3">
                    <label for="role">Gebruikersrol <span class="text-danger">*</span></label>

                    <select @input('role') id="role" class="custom-select @error('role', 'is-invalid')">
                        <option value="">-- selecteer gebruikersrol --</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @if(old('role') === $role->name) selected @endif>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-success shadow-sm">Opslaan</button>
                    <button type="reset" class="btn btn-light shadow-sm">Reset</button>
                </div>
            </div>
        </form>
    </div>
@endsection