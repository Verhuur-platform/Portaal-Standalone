@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 pb-3">
    <div class="row">
        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-calendar"></i>
                    </span>

                    <div>
                        <h5 class="m-0">{{ $counters['leases']['all'] }} <small>Verhuringen</small></h5>
                        <small class="text-muted">0 nieuwe aanvragen</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-users"></i>
                    </span>

                    <div>
                        <h5 class="m-0">{{ $counters['users']['all'] }} <small>Gebruikers</small></h5>
                        <small class="text-muted">Waarvan {{ $counters['users']['deactivated'] }} gedactiveerd</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-user"></i>
                    </span>

                    <div>
                        <h5 class="m-0">{{ $counters['tenants']['all'] }} <small>Huurders</small></h5>
                        <small class="text-muted">{{ $counters['tenants']['today'] }} toegevoegd vandaag</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header-overview">
            <span class="text-sgv-brown" style="font-weight:650;"><i class="fe fe-calendar mr-1"></i> Nieuwe aanvragen</span>

            <a href="{{ route('lease.dashboard') }}" style="font-weight:650;" class="text-decoration-none text-sgv-brown float-right">
                <i class="fe fe-list mr-1"></i> Alle verhuringen
            </a>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Huurder</th>
                        <th>Periode</th>
                        <th>Aantal personen</th>
                        <th>Toegevoegd op</th>
                        <th>&nbsp;</th> {{-- Column field for the options only --}}
                    </tr>
                </thead>
                    <tbody>
                        @forelse ($newLeases as $lease)
                            <tr>
                                <td class="text-secondary table-id">#{{ $lease->id }}</td>
                                <td>{{ $lease->tenant->full_name }}</td>
                                <td>{{ $lease->period }}</td>
                                <td>{{ $lease->persons }} Personen</td>
                                <td>{{ $lease->created_at->diffForHumans() }}</td>
                                <td>
                                    <span class="float-right">
                                        <a href="{{ route('lease.show', $lease) }}" class="text-secondary text-decoration-none">
                                            <i class="fe fe-eye mr-1"></i> Bekijk
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-no-results">
                                    <i class="icon fe fe-info mr-2"></i>
                                    Er zijn momenteel geen nieuwe verhuringen aangevraagd.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
