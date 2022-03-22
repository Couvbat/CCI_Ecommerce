<div class="container">
	<div class="row gutters py-5">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
					<div class="card h-100">
							<div class="card-body">
									<div class="account-settings">
											<div class="user-profile">
													<div class="user-name mt-3">
															<h5 class="user-name text-center">{{ auth()->user()->name }}</h5>
															<h6 class="user-email text-center">{{ auth()->user()->email }}</h6>
													</div>
											</div>
											<div class="buttons d-flex flex-column">
													@if(!auth()->user()->provider_id)
															<a href="{{ route('user.changePassword') }}" type="button" class="btn btn-success mb-2">
																	<i class="fas fa-key"></i>
																	Changer de mot de passe
															</a>
													@endif
													<button class="btn btn-danger" type="button" id="deleteAccountBtn">
															<i class="fas fa-user-times"></i>
															Supprimé votre compte
													</button>
											</div>
									</div>
							</div>
					</div>
			</div>
			<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
					<div class="card h-100">
							<form method="POST" action="{{ route('user.update', auth()->user()->id) }}" class="d-inline-block">
									@csrf
									@method('PATCH')
									<div class="card-body">
											<div class="row gutters">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<h6 class="mb-2 text-primary">Détails personel</h6>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="fullName">Prénom</label>
																	<input type="text" class="form-control @error('name') is-invalid @enderror"
																				 name="name"
																				 id="fullName"
																				 placeholder="" value="{{ auth()->user()->firstName }}">
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="fullName">Nom de famille</label>
																	<input type="text" class="form-control @error('name') is-invalid @enderror"
																				 name="name"
																				 id="fullName"
																				 placeholder="" value="{{ auth()->user()->lastName }}">
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="eMail">Email</label>
																	<input type="email" class="form-control @error('email') is-invalid @enderror"
																				 name="email" id="eMail" placeholder=""
																				 value="{{ auth()->user()->email }}">
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
														<div class="form-group">
																<label for="phone">Numéro de téléphone</label>
																<input type="phone" class="form-control @error('phone') is-invalid @enderror"
																			 name="phone" id="phone" placeholder=""
																			 value="{{ auth()->user()->phone }}">
														</div>
												</div>
											</div>
											<div class="row gutters">
													<div
															class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between">
															<h6 class="mt-3 mb-2 text-primary">
																	Address
																	@if(auth()->user()->shipping)
																			<a href="{{ route('shipping.edit') }}">
																					<i class="far fa-edit"></i>
																			</a>
																	@else
																			<a href="{{ route('shipping.store') }}">
																					<i class="far fa-edit"></i>
																			</a>
																	@endif
															</h6>
													</div>

													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="city">Ville</label>
																	<input type="name" class="form-control" id="city" placeholder="Saisissez votre ville"
																				 value="{{ auth()->user()->shipping->city ?? '' }}" readonly>
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="street_nb">Numéro de rue</label>
																	<input type="name" class="form-control" id="street_nb" placeholder="Saisissez votre numéro de rue"
																				 value="{{ auth()->user()->shipping->street_nb ?? '' }}" readonly>
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="form-group">
																	<label for="street">Rue</label>
																	<input type="name" class="form-control" id="street" placeholder="Saisissez votre rue"
																				 value="{{ auth()->user()->shipping->street ?? '' }}" readonly>
															</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
														<div class="form-group">
																<label for="additional_info">Informations additionelles</label>
																<input type="name" class="form-control" id="additional_info" placeholder="(optionel)"
																			 value="{{ auth()->user()->shipping->additional_info ?? '' }}" readonly>
														</div>
													</div>

											</div>
											<div class="row gutters">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="text-right">
																	<a href="{{ route('home') }}" class="btn btn-secondary">
																			Annuler
																	</a>
																	<button type="submit" id="submit" name="submit" class="btn btn-primary">
																			Sauvegarder
																	</button>
															</div>
													</div>
											</div>
									</div>
							</form>
					</div>
			</div>
	</div>
</div>
