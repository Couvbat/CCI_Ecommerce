@extends('layouts.app')


@section('title') Create an account @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-uppercase">S'inscrire</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="firstName">{{ __('Prénom') }}</label>
                                <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                                       name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
                                @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
														<div class="form-group">
															<label for="lastName">{{ __('Nom de famille') }}</label>
															<input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
																		 name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
															@error('lastName')
															<span class="invalid-feedback" role="alert">
																			<strong>{{ $message }}</strong>
																	</span>
															@enderror
													</div>

                            <div class="form-group">
                                <label for="email">Adresse email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">
																	Nous ne partagerons votre email avec personne
                                </small>
                            </div>

														<div class="form-group">
															<label for="phone">Numéro de téléphone</label>
															<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
																		 name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

															@error('phone')
															<span class="invalid-feedback" role="alert">
																			<strong>{{ $message }}</strong>
																	</span>
															@enderror
															<small id="phoneHelp" class="form-text text-muted">
																Nous ne partagerons votre numéro de téléphone avec personne
															</small>
													</div>

                            <div class="form-group">
                                <label for="password">{{ __('Mot de passe') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirmer votre mot de passe') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('S\'inscrire') }}
                                </button>

                                <div class="float-right mb-0">
                                    <span>
                                        Déja inscrit
                                        <a class="btn btn-link btn-sm m-0 p-0"
                                           href="{{ route('login') }}">
                                        {{ __('Se connecter') }}
                                        </a>
                                    </span>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
