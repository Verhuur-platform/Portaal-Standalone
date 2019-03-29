@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-icon alert-{{ $message['level'] }}
            {{-- .alert-important is used by jquery to not auto hide the flash alert dialog --}}
            {{ $message['important'] ? 'alert-dismissible alert-important fade show' : '' }}" role="alert">
            
            @if ($message['important'])
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endif

            @switch ($message['level'])
                @case('danger')  
                    <i class="icon fe fe-alert-octagon" aria-hidden="true"></i> 
                    <span class="font-weight-bold mr-2">Foutmelding:</span>
                @break

                @case('warning') 
                    <i class="icon fe fe-alert-octagon" aria-hidden="true"></i>
                    <span class="font-weight-bold mr-2">Waarschuwing</span> 
                @break

                @case('success') 
                    <i class="icon fe fe-check" aria-hidden="true"></i> 
                    <span class="font-weight-bold mr-2">Succes:</span>         
                @break

                @case('info')
                    <i class="icon fe fe-info" aria-hidden="true"></i>
                    <span class="font-weight-bold mr-2">Info:</span>               
                @break

                @default <i class="icon fe fe-bell" aria-hidden="true"></i>
            @endswitch

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
