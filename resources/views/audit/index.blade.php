@extends ('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Activiteits audit</h1>
            <div class="page-subtitle">Overzicht</div> 
        </div> 
    </div>

    <div class="container-fluid pb-3">
        @include ('flash::message') {{-- Flash session view partial --}}

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0 card-table table-vcenter text-nowrap">
                    <thead>
                        <th>Gebruiker</th>
                        <th>Categorie</th>
                        <th>Bericht</th>
                        <th>Tijdstip</th>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td><span class="text-muted table-id">{{ $log->causer->name }}</span></td>
                                <td>{{ $log->log_name }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            </td>
                        @empty
                            <tr>
                                <td colspan="5" class="table-no-results">
                                    <i class="icon fe fe-info mr-2"></i> 
                                    Er zijn momenteel geen logs gevonden in {{ config('app.name') }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

       {{ $logs->links() }} {{-- Pagination view instance --}}
    </div>
@endsection