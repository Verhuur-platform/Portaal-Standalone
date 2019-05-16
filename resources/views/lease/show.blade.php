@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Verhuring</h1>
            <div class="page-subtitle">Algemene informatie</div>

            <div class="page-options d-flex">
                <a class="btn btn-shadow btn-secondary" href="{{ route('lease.dashboard') }}">
                    <i class="fe fe-list mr-2"></i> Verhuringen
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <form class="card card-body border-0 shadow-sm" action="" method="POST">
                    <h6 class="border-bottom border-gray pb-1 mb-4">Algemene informatie</h6> 

                    @csrf               {{-- Form field protection --}}
                    @method('patch')    {{-- HTTP method spoofind --}}
                    @form($lease)       {{-- Bind lease data to the form --}}

                    <div class="form-row">
                        <div class="col-3">
                            <h5>Informatie huurder</h5>
                            
                            <p class="card-text text-secondary small">
                                <i class="fe font-weight-bold fe-info mr-2"></i>
                                Het wijzigen van de informatie omtrent de huurder kan via de huurders sectie van het portaal.
                            </p>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="firstname">Voornaam</label>
                                    <input type="text" id="firstname" class="form-control" value="{{ $lease->tenant->firstname }}" disabled>
                                </div>

                                <div class="form-group col-6">
                                    <label for="lastname">Achternaam</label>
                                    <input type="text" id="lastname" class="form-control" value="{{ $lease->tenant->lastname}}" disabled>
                                </div>

                                <div class="form-group col-6">
                                    <label for="telNumber">Telefoon nr</label>
                                    <input type="text" id="telNumber" class="form-control" value="{{ $lease->tenant->tel_nr ?? 'Niet bekend' }}" disabled> 
                                </div>

                                <div class="form-group col-6">
                                    <label for="email">E-mail adres</label>
                                    <input type="email" id="email" class="form-control" value="{{ $lease->tenant->email}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <fieldset @if ($cantEdit) disabled @endif>
                        <div class="form-row">
                            <div class="col-3">
                                <h5>Informatie verhuring</h5>
                            </div>

                            <div class="offset-1 col-8">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="startDate">Start datum <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('start_date', 'invalid')" id="startDate" name="start_date" value="{{ $lease->start_date->format('Y-m-d') }}">
                                        @error('start_date')
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="endDate">Eind datum <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('end_date', 'is-invalid')" id="endDate" name="end_date" value="{{ $lease->end_date->format('Y-m-d') }}">
                                        @error('end_date')
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="persons">Aantal personen <span class="text-danger">*</span></label>
                                        <input type="text" id="persons" class="form-control @error('persons', 'is-invalid')" placeholder="Aantal personen" @input('persons')>
                                        @error('persons')
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="followUp">Opgevolgd door</label> 
                                        <input type="text" class="form-control" disabled id="followUp" value="{{ $lease->successor->name ?? 'Niemand' }}">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    @if (! $cantEdit)
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-12 mb-0">
                                <button type="submit" class="float-right btn btn-secondary">Aanpassen</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div> {{-- /// Content --}}

            <div class="col-md-3"> {{-- sidebar --}}
                @include ('lease.partials.sidenav', ['lease' => $lease])
            </div> {{-- /// Sidebar --}}
        </div>
    </div>
@endsection