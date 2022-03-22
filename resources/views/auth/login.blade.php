@extends('layouts.app')


@section('title') Connexion @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-8">

                <h2 class="text-uppercase">Connexion</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <small id="emailHelp" class="form-text text-muted">Nous ne partagerons votre email avec personne</small>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link btn-sm float-right" style="font-size: 0.8rem"
                               href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif

                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <div class="mt-3">
                        <span style="font-size: 0.8rem">
                            Nouveau client ?
                            <a class="btn btn-link btn-sm"
                               href="{{ route('register') }}">
                        {{ __('S\'inscrire') }}
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
