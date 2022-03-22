@extends('layouts.app')

@section('title')
    Adresse
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT SHIPPING   ================================= -->
    <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
      <article class="card-body">
        <header class="mb-4">
            <h4 class="card-title">
            Modifier votre adresse
            <span class="float-right"> <a href="{{ route('my_orders') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                  Retour
                </a>
            </span>
            </h4>
        </header>
        <form method="POST" action="{{ route('shipping.update') }}">
          @csrf
          @method('PATCH')

          <div class="form-row">
            <div class="col form-group mb-3">
              <label>Ville</label>
              <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ auth()->user()->shipping->city }}" autocomplete="city" autofocus placeholder="Paris" />

              @error('city')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
					<div class="form-row">
            <div class="col form-group mb-3">
              <label>Numéro de rue</label>
              <input type="text" id="street_nb" class="form-control @error('street_nb') is-invalid @enderror" name="street_nb" value="{{ auth()->user()->shipping->street_nb }}" autocomplete="street_nb" autofocus placeholder="42" />

              @error('street_nb')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
					<div class="form-row">
            <div class="col form-group mb-3">
              <label>Rue</label>
              <input type="text" id="street" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ auth()->user()->shipping->street }}" autocomplete="street" autofocus placeholder="Rue voltaire" />

              @error('street')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
					<div class="form-row">
            <div class="col form-group mb-3">
              <label>Informations additionelles</label>
              <input type="text" id="additional_info" class="form-control @error('additional_info') is-invalid @enderror" name="additional_info" value="{{ auth()->user()->shipping->additional_info }}" autocomplete="additional_info" autofocus placeholder="(optionel)" />

              @error('additional_info')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

            <button type="submit" id="shipping-btn" class="btn btn-primary btn-block">
              Mettre à jour
            </button>

        </form>
      </article>
      <!-- card-body. -->
    </div>
    <!-- card  -->
    <br /><br />
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
  </section>

@endsection

