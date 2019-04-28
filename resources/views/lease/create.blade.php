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
        <form action="" method="post" class="card card-body border-0 shadow-sm">
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
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="startDate">Start datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date', 'is-invalid')" id="startDate">
                            @error('start_date')
                        </div>

                        <div class="form-group col-6">
                            <label for="endDate">Eind datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date', 'is-invalid')" id="endDate">
                            @error('end_date')
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