@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="text-center">Registracija</h1>
    </div>
    <register-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
        <form @submit="validate" action="{{ route('register') }}" method="POST" class="mt-5">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6 offset-lg-3">
                    <label for="email">Email</label>
                    <input v-model="inputs.email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" :class="isInvalid('email')" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div v-cloak v-if="errors.email.status" v-html="errors.email.message" class="invalid-feedback"></div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 offset-lg-3">
                    <label for="password">Lozinka</label>
                    <input v-model="inputs.password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" :class="isInvalid('password')" name="password" required autocomplete="new-password">
                    <div v-cloak v-if="errors.password.status" v-html="errors.password.message" class="invalid-feedback"></div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 offset-lg-3">
                    <label for="password">Ponovna lozinka</label>
                    <input v-model="inputs.passwordConfirmation" id="passwordConfirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-lg-6 offset-lg-3">
                    <button class="btn btn-warning w-100" :disabled="isDisabled">Registracija</button>
                </div>
            </div>
            <div class="row mt-1">
                <div class="form-group col-lg-6 offset-lg-3">
                    <a href="/login" class="btn btn-secondary w-100">Prijava</a>
                </div>
            </div>
        </form>
    </register-form>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
