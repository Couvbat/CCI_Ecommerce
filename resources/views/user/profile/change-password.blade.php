@extends('layouts.app')

@section('title')
    Change Password
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT PROFILE   ================================= -->
    <div class="container">
        <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
            <article class="card-body">
              <header class="mb-4">
                  <h4 class="card-title">
                      Change password
                      <span class="float-right"> <a href="/profiles">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                          Back
                        </a>
                      </span>
                    </h4>
                </header>
              <form method="POST" action="{{ route('user.change', auth()->user()->id) }}">
                @csrf
                @method('PATCH')


                <div class="form-row">
                    <div class="form-group mb-3 col-md-12">
                      <label>Old Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="old_password" autocomplete="old_password" autofocus />

                      <small class="form-text text-muted"
                      >Please type your old password.</small
                    >

                      @error('old_password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus />


                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" autofocus />

                    <small class="form-text text-muted"
                    >Please repeat your password for security.</small>

                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


                <button type="submit" name="submit" class="btn btn-primary btn-block">
                  Change password
                </button>
              </form>
            </article>
            <!-- card-body. -->
          </div>
    </div>
    <!-- card  -->
    <br /><br />
    <!-- ============================ COMPONENT PROFILE  END.// ================================= -->
  </section>

@endsection
