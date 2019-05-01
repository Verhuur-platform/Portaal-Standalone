@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Verhuringen</h1>
            <div class="page-subtitle">Nieuwe verhuring</div>

            <div class="page-options d-flex">
                <a class="btn btn-shadow btn-secondary" href="{{ route('lease.dashboard') }}">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form action="{{ route('lease.store') }}" method="post" class="card card-body border-0 shadow-sm">
            @csrf {{-- Form field protection --}}
            <h6 class="border-bottom border-gray pb-1 mb-4">Verhuring toevoegen</h6>

            <div class="form-row">
                <div class="col-3">
                    <h5>Informatie huurder</h5>
                    <p class="card-text text-secondary small">
                        <i class="fe font-weight-bold fe-info mr-2"></i>
                        Indien er een huurder op basis van de voornaam, achternaam en email adres word gevonden. Zal het portaal
                        deze huurder gebruiken in plaats van een nieuwe huurder aan te maken. 
                    </p>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="firstname">Voornaam <span class="text-danger">*</span></label>
                            <input type="text" id="firstname" class="form-control @error('firstname', 'is-invalid')" placeholder="Voornaam van de huurder" @input('firstname')>
                            @error('firstname')
                        </div>

                        <div class="form-group col-6">
                            <label for="lastname">Achternaam <span class="text-danger">*</span></label>
                            <input type="text" id="lastname" class="form-control @error('lastname', 'is-invalid')" placeholder="Achternaam van de huurder" @input('lastname')>
                            @error('lastname')
                        </div>

                        <div class="form-group col-6">
                            <label for="telNumber">Telefoon nr</label>
                            <input type="text" id="telNumber" class="form-control @error('tel_nr', 'is-invalid')" placeholder="Teleoon nummer van de huurder" @input('tel_nr')> 
                            @error('tel_nr')
                        </div>

                        <div class="form-group col-6">
                            <label for="email">E-mail adres <span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control @error('email', 'is-invalid')" placeholder="Email adres van de huurder" @input('email')>
                            @error('email')
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="col-3">
                    <h5>Informatie verhuring</h5>
                    <p class="card-text text-secondary small">
                        <i class="fe font-weight-bold fe-info mr-2"></i>
                        Indien er geen opvolger word aangeduid. Zal de gebruiker die de verhuring registreerd aangeduid worden als opvolger.
                    </p>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="startDate">Start datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date', 'is-invalid')" id="startDate" @input('start_date')>
                            @error('start_date')
                        </div>

                        <div class="form-group col-6">
                            <label for="endDate">Eind datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date', 'is-invalid')" id="endDate" @input('end_date')>
                            @error('end_date')
                        </div>

                        <div class="form-group col-4">
                            <label for="persons">Aantal personen <span class="text-danger">*</span></label>
                            <input type="text" id="persons" class="form-control @error('persons', 'is-invalid')" placeholder="Aantal personen" @input('persons')>
                            @error('persons')
                        </div>
                        
                        <div class="form-group col-4">
                            <label for="followUp">Opgevolgd door</label>

                            <select id="followUp" class="custom-select @error('follower_id', 'is-invalid')" @input('follower_id')>
                                <option value="">-- opvolger --</option>

                                @foreach ($users as $user) {{-- Loop through the users --}}
                                    <option value="{{ $user->id }}" @if ($user->id === old('follower_id')) selected @endif>
                                        {{ ucfirst($user->name) }}
                                    </option>
                                @endforeach {{-- /// END loop --}}
                            </select>

                            @error('follower_id') {{-- Validation error view partial --}}
                        </div>

                        <div class="form-group col-4">
                            <label id="status">Status <span class="text-danger">*</span></label>

                            <select id="status" class="custom-select @error('status', 'is-invalid')" @input('status')>
                                <option value="">-- status --</option>
                            
                                @foreach ($statusses as $status) {{-- Status loop --}}
                                    <option value="{{ $status->id }}" @if ($status->id == old('status')) selected @endif>
                                        {{ ucfirst($status->name) }}
                                    </option>
                                @endforeach {{-- /// END status loop --}}
                            </select>

                            @error('status') {{-- Validation error view partial --}}
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group col-12 mb-0"> 
                    <button type="sumbit" class="float-right btn btn-secondary">Toevoegen</button>
                </div>
            </div>
        </form>
    </div>
@endsection