@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="text-center">Prijava</h1>
    </div>
    @if (session('status'))
        <div>
            <h4 class="text-success text-center">{{ session('status') }}</h4>
        </div>
    @endif
    <login-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
        <form @submit="validate" action="{{ route('login') }}" method="POST" class="mt-5">
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
                    <input v-model="inputs.password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" :class="isInvalid('password')" name="password" required autocomplete="current-password">
                    <div v-cloak v-if="errors.password.status" v-html="errors.password.message" class="invalid-feedback"></div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 offset-lg-3 col-6 pt-2">
                    <div class="form-check">
                        <input v-model="inputs.remember" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Upamti me
                        </label>
                    </div>
                </div>
                <div class="col-lg-3 col-6 text-right">
                    @if (Route::has('password.request'))
                        <a class="btn btn-outline-warning" href="{{ route('password.request') }}">
                            Zaboravili ste lozinku?
                        </a>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-lg-6 offset-lg-3">
                    <button class="btn btn-warning w-100" :disabled="isDisabled">Prijava</button>
                </div>
            </div>
            <div class="row mt-1">
                <div class="form-group col-lg-6 offset-lg-3">
                    <a href="/register" class="btn btn-secondary w-100">Registracija</a>
                </div>
            </div>
        </form>
    </login-form>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Prijava</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Lozinka</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Upamti me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Prijava
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Zaboravili ste lozinku?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
