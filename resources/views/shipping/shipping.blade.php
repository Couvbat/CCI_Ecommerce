@extends('layouts.app')

@section('title')
    Livraison
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT SHIPPING   ================================= -->
    <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
      <article class="card-body">
        <header class="mb-4"><h4 class="card-title">Addresse</h4></header>
        <form method="POST" action="{{ route('shipping.store') }}">
          @csrf
          <div class="form-row">
            <div class="col form-group mb-3">
              <label>Ville</label>
              <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city" autofocus placeholder="eg. Paris" />

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
              <input type="number" id="street_nb" class="form-control @error('street_nb') is-invalid @enderror" name="street_nb" value="{{ old('street_nb') }}" autocomplete="street_nb" autofocus placeholder="eg. 52" />

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
              <input type="text" id="street" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" autocomplete="street" autofocus placeholder="eg. Rue Voltaire" />

              @error('street')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

					<div class="form-row">
            <div class="col form-group mb-3">
              <label>Informations complementaires</label>
              <input type="text" id="additional_info" class="form-control @error('additional_info') is-invalid @enderror" name="additional_info" value="{{ old('additional_info') }}" autocomplete="additional_info" autofocus placeholder="eg. Digicode" />

              @error('additional_info')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <button type="submit" id="shipping-btn" class="btn btn-primary btn-block">
            Créer l'adresse
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

@section('extra-js')
  <script src="{{ asset('js/address.js') }}"></script>
@endsection
