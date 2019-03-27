@extends('layouts.auth')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand shadow-lg">
                        <img src="{{ asset('img/logo-auth.jpg') }}">
                    </div>
                    <div class="card fat shadow-lg">
                        <div class="card-body">
                            <h4 class="card-title">Wachtwoord vergeten</h4>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf {{-- Form field protection --}}

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        <small>{{ session('status') }}</small>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="email">E-Mail Adres</label>
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @else
                                        <div class="form-text text-muted">
                                            <small>Bij het klikken op de knop zullen we je een email sturen</small>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-sgv-brown btn-block">
                                        Reset wachtwoord
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
