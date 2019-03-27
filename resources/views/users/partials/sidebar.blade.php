<div class="list-group list-group-transparent">
    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-info text-sgv-brown mr-3"></i> Account informatie
    </a>
                    
    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-list text-sgv-brown mr-3"></i> Activiteit audit 
    </a>

    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-lock text-sgv-brown mr-3"></i> Deactiveer login
    </a> 

    <a href="{{ route('users.delete', $user) }}" class="list-group-item list-group-item-action {{ active('users.delete') }}">
        <i class="fe fe-trash-2 text-sgv-brown mr-3"></i> Verwijder account
    </a>
</div>