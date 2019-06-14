@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('premises.create') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

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
                <table class="table table-hover mb-0 card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Lokaal</th>
                            <th>Aantal personen</th>
                            <th>Werkpunten</th>
                            <th>&nbsp;</th>{{-- Column for the options --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($premises as $premise) {{-- Loop trough the premises --}}
                        @empty {{-- No premises are found --}}
                        @endif {{-- /// END premises --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
