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
                            <h4 class="card-title">Aanmelden</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf {{-- Form field protection --}}

                                <div class="form-group">
                                    <label for="email">E-Mail Adres</label>

                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Wachtwoord
                                        <a href="{{ route('password.request') }}" class="float-right">
                                            Wachtwoord vergeten?
                                        </a>
                                    </label>

                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Onthoud mij
                                    </label>
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-sgv-brown btn-block">
                                        Aanmelden
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