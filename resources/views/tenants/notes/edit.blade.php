@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $note->notable->full_name }}</h1>
            <div class="page-subtitle">Notitie wijzigen</div>

            <div class="page-options d-flex">
                <div class="btn-group shadow-sm">
                    <a href="{{ route('tenant.notes', $note->notable) }}" class="btn btn-secondary">
                        <i class="fe fe-list mr-2"></i> Notities
                    </a>
                    <a href="{{ route('tenants.dashboard') }}" class="btn btn-secondary">
                        <i class="fe fe-users mr-2"></i> Huurders
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-9">
                <form method="POST" action="{{ route('tenant.notes.update', $note) }}" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">Notitie wijzigen van <strong>{{ $note->notable->full_name }}</strong></h6>

                    @csrf                      {{-- Form field protection --}}
                    @method('PUT')             {{-- HTTP method spoofing --}}
                    @form ($note)              {{-- Bind note data to the form --}}
                    @include('flash::message') {{--Flash session view partial --}}

                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="titel">Titel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titel', 'is-invalid')" id="titel" placeholder="Notitie titel" @input('titel')>
                            @error('titel')
                        </div>

                        <div class="form-group col-12">
                            <label for="content">Beschrijving <span class="text-danger">*</span></label>
                            <textarea id="content" rows="4" class="form-control @error('content', 'is-invalid')" @input('content') `placeholder="Notitie">{{ old('content') ?? $note->content }}</textarea>
                            @error('content')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="mb-0 form-group col-12">
                            <button type="submit" class="btn btn-secondary">
                                Aanpassen
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-3">
                @include ('tenants.partials.sidebar', ['tenant' => $note->notable])
            </div>
        </div>
    </div>
@endsection