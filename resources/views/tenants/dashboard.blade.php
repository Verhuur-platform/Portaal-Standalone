@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.create') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="form-search ml-2">
                    <input type="text" class="form-control border-0 shadow-sm" @input('term') placeholder="Zoeken">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @include ('flash::message') {{-- Flash session view partial --}}

        <div class="card">
            <div class="table-responsive">
                <table class="table @if(count($tenants) > 0) table-hover @endif mb-0 card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naam</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tel. nummer</th>
                            <th scope="col">&nbsp;</th> {{-- Column for the functions only --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tenants as $tenant)
                            <tr>
                                <th scope="row"><span class="text-muted table-id">#{{ $tenant->id }}</span></th>
                                <th>{{ $tenant->full_name }}</th>
                            </tr>
                        @empty {{-- No tenants found with the given criteria --}}
                            <tr>
                                <td colspan="5" class="table-no-results">
                                    <i class="icon fe fe-info mr-2"></i> Er zijn momenteel geen huurders gevonden met de matchende criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection