@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ $tenant->full_name }}</h1>
            <div class="page-subtitle">verwijderen als huurder</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.dashboard') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-9">
                <form method="POST" action="{{ route('tenants.delete', $tenant) }}" class="card card-body border-0 shadow-sm">
                    @csrf {{-- Form field protection --}}
                    @method('DELETE') {{-- HTTP method spoofing --}}

                    <h6 class="border-bottom border-gray pb-1 mb-3">{{ $tenant->full_name }} verwijderen als huurder</h6>

                    <p class="card-text text-danger">
                        <i class="icon fe fe-alert-triangle mr-1"></i> U staat op het punt om een huurder te verwijderen in het portaal.
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van <strong>{{ $tenant->full_name }}</strong> als huurder.
                        Zal alle data verwijderd van deze huurder. Alsook word deze data nog een 2tal weken bewaard worden.
                        Zodat de webmaster de verwijdering nog kan omkeren indien nodig.
                    </p>

                    <hr class="mt-0">

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-danger shadow-sm">
                            <i class="fe fe-trash-2 mr-1"></i> Verwijderen
                        </button>

                        <a href="" class="btn btn-shadow btn-light">
                            Annuleren
                        </a>
                    </div>
                </form>
            </div>

            <div class="col-3">
                @include('tenants.partials.sidebar', ['tenant' => $tenant])
            </div>
        </div>
    </div>
@endsection