@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Verhuringen</h1>
            <div class="page-subtitle">Beheerspaneel</div>

            <div class="page-options d-flex">
                <a href="{{ route('lease.create') }}" class="btn shadow-sm btn-secondary mr-2">
                    <i class="fe fe-plus"></i>
                </a>

                <div class="btn-group">
                    <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe mr-2 fe-filter"></i> Filter
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">Nieuwe aanvragen</a>
                    </div>
                </div>

                <form method="GET" action="" class="form-search ml-2">
                    <input type="text" class="form-control border-0 shadow-sm" @input('term') placeholder="Zoeken">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="card">
            <div class="table-responsive">
                <table class="table @if (count($leases) > 0) table-hover @endif mb-0 card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Status</th>
                            <th>Huurder</th>
                            <th>Periode</th>
                            <th>Aantal personen</th>
                            <th>Aangevraagd op</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leases as $lease) {{-- There are leases found --}}
                        @empty {{-- No leases are found with the matching criteria --}}
                            <tr>
                                <td colspan="7" class="table-no-results">
                                    <i class="icon fe fe-info mr-2"></i>
                                    Er zijn geen verhuringen gevonden met de matchende term of criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection