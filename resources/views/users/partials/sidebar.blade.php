<div class="list-group list-group-transparent">
    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-info text-sgv-brown mr-3"></i> Account informatie
    </a>

    @if ($currentUser->can('same-user', $user))
        <a href="{{ route('users.account.security') }}" class="list-group-item list-group-item-action {{ active('users.account.security') }}">
            <i class="fe fe-shield text-sgv-brown mr-3"></i> Account beveiliging
        </a>
    @endif
                    
    @if ($currentUser->hasRole('webmaster'))
        <a href="" class="list-group-item list-group-item-action">
            <i class="fe fe-list text-sgv-brown mr-3"></i> Activiteit audit 
        </a> 
    @endif

    @if ($currentUser->can('create-lock', $user))
        <a href="{{ route('users.lock', $user) }}" class="list-group-item list-group-item-action {{ active('users.lock') }}">
            <i class="fe fe-lock text-sgv-brown mr-3"></i> Deactiveer login
        </a>
    @elseif($currentUser->can('remove-lock', $user)) 
        <a href="" class="list-group-item list-group-item-action">
            <i class="fe fe-unlock text-sgv-brown mr-3"></i> Deactivatie opheffen
        </a>
    @endif

    <a href="{{ route('users.delete', $user) }}" class="list-group-item list-group-item-action {{ active('users.delete') }}">
        <i class="fe fe-trash-2 text-sgv-brown mr-3"></i> Verwijder account
    </a>
</div>