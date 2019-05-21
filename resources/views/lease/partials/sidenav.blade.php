<div class="list-group list-group-transparent">
    <a href="{{ route('lease.show', $lease) }}" class="list-group-item list-group-item-action {{ active('lease.show') }}">
        <i class="fe fe-info text-sgv-brown mr-3"></i> Informatie
    </a>

    <a href="{{ route('lease.notes.dashboard', $lease) }}" class="list-group-item {{ active('lease.notes.dashboard') }} list-group-item-action">
        <i class="fe fe-edit-2 text-sgv-brown mr-3"></i> Notities
    </a>

    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-file-text text-sgv-borwn mr-3"></i> Documenten
    </a>
</div>