@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="text-center">Podešavanje profila</h1>
    </div>
    <div class="d-flex justify-content-center pt-4">
        <h2 class="text-center">Promena email adrese</h2>
    </div>
    <reset-email-form :model="{{json_encode(Auth::user())}}" inline-template>
        <form @submit="validate" action="/profile" method="POST" class="mt-2">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6 offset-lg-3">
                    <label for="email">Email</label>
                    <input v-model="inputs.email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" :class="isInvalid('email')" name="email" required autocomplete="email" autofocus>
                    <div v-cloak v-if="errors.email.status" v-html="errors.email.message" class="invalid-feedback"></div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-lg-6 offset-lg-3">
                    <button class="btn btn-warning w-100" :disabled="isDisabled">Promeni email</button>
                </div>
            </div>
        </form>
    </reset-email-form>

    <div class="d-flex justify-content-center pt-4">
        <h2 class="text-center">Promena lozinke</h2>
    </div>
    <password-form inline-template>
        <form @submit="validate" action="/profile" method="POST" class="mt-2">
            @csrf
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
                    <button class="btn btn-warning w-100" :disabled="isDisabled">Promeni lozinku</button>
                </div>
            </div>
        </form>
    </password-form>
    <div class="row mt-5">
        <div class="form-group col-lg-6 offset-lg-3">
            <a href="/" class="btn btn-secondary w-100">Početna</a>
        </div>
    </div>
</div>
@endsection
