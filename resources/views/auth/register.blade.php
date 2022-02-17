@extends('layouts.appauth')
@section('content')
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-8 col-10 d-flex justify-content-center">
                <div class="card bg-authentication rounded-0 mb-0">
                    <div class="row m-0">
                        <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                            <img src="{{asset('app-assets/images/pages/register.jpg')}}" alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="card rounded-0 mb-0 p-2">
                                <div class="card-header pt-50 pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Create Account</h4>
                                    </div>
                                </div>
                                <p class="px-2">Fill the below form to create a new account.</p>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-label-group">
                                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                <label for="name">{{ __('Name') }}</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-label-group">
                                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                <label for="email">{{ __('E-Mail Address') }}</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-label-group">
                                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                                <label for="password">{{ __('Password') }}</label>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-label-group">
                                                <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <div class="col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" checked>
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class=""> I accept the terms & conditions.</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div> --}}
                                            @if (Route::has('login'))
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline mb-50">{{ __('Login') }}</a>
                                            @endif
                                            <button type="submit" class="btn btn-primary float-right btn-inline mb-50">{{ __('Register') }}</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection