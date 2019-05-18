@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $tenant->full_name }}</h1>
            <div class="page-subtitle">Facturatie gegevens</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.dashboard') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-9">
                <form method="POST" action="{{ route('tenant.billing.store', $tenant) }}" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-4">Facturatie gegevens</h6>

                    @csrf                       {{-- Form field protection --}}
                    @include('flash::message')  {{-- Flash session view partial --}}
                    @form($billingInfo)         {{-- Bind billing data to the form --}}

                    <div class="form-row">
                        <div class="col-3">
                            <h5>Algemene gegevens</h5>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="firstname">Voornaam</label>
                                    <input type="text" class="form-control" value="{{ ucfirst($tenant->firstname) }}" disabled id="firstname">
                                </div>

                                <div class="form-group col-6">
                                    <label for="lastname">Achternaam</label>
                                    <input type="text" class="form-control" value="{{ ucfirst($tenant->lastname) }}" disabled id="lastname">
                                </div>

                                <div class="form-group col-12">
                                    <label for="group">Groeps of organisatie naam</label>
                                    <input type="text" placeholder="Naam v/d groep of organisatie" class="form-control" @input('group_or_organisation') id="group">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="col-3">
                            <h5>Adres gegevens</h5>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="address">Adres + huisnummer</label>
                                    <input id="address" type="text" class="form-control" placeholder="Adres + huisnummer" @input('address')>
                                </div>

                                <div class="form-group col-4">
                                    <label for="postal">Postcode</label>
                                    <input id="postal" type="text" class="form-control" placeholder="Postcode" @input('postal')>
                                </div>

                                <div class="form-group col-4">
                                    <label for="city">Stad</label>
                                    <input id="city" type="text" class="form-control" placeholder="Stad" @input('city')>
                                </div>

                                <div class="form-group col-4">
                                    <label for="country">Land</label>
                                    <input id="country" type="text" class="form-control" placeholder="Land" @input('country')>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn float-right btn-secondary mb-0">Aanpassen</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-3"> {{-- Sidebar --}}
                @include('tenants.partials.sidebar', ['tenant' => $tenant])
            </div> {{-- /// END sidebar --}}
        </div>
    </div>
@endsection