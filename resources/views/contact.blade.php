@extends('layouts.app')

@section('title')
    Contact
@endsection

@section('content')
<section id="contact">
	<div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
		<article class="card-body">
			<header class="mb-4">
					<h4 class="card-title">
					Nous Contacter
					<span class="float-right"> <a href="{{ route('home') }}">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
								Retour
							</a>
					</span>
					</h4>
			</header>
			<form method="POST" action="{{ route('contact.store') }}">
				@csrf
				@method('POST')

				<div class="form-row">
					<div class="col form-group mb-3">
						<label>Adresse email</label>
						<input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->shipping->email }}" autocomplete="email" autofocus/>

						@error('email')
						<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-row">
					<div class="col form-group mb-3">
						<label>Objet</label>
						<input type="text" id="object" class="form-control @error('object') is-invalid @enderror" name="object" value="{{ auth()->user()->shipping->object }}" autocomplete="object" autofocus/>

						@error('object')
						<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-row">
					<div class="col form-group mb-3">
						<label>Message</label>
						<textarea id="msg" class="form-control @error('msg') is-invalid @enderror" name="msg" value="{{ auth()->user()->shipping->msg }}" autocomplete="msg" autofocus></textarea>

						@error('msg')
						<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
					<button type="submit" id="shipping-btn" class="btn btn-primary btn-block">
						Envoyer
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
