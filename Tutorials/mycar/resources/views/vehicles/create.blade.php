@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="text-center">Dodaj novo vozilo</h1>
        </div>
        <vehicle-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
            <form @submit="validate" action="/vehicles" method="POST" class="mt-5">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="make">Marka</label>
                        <input v-model="inputs.make" type="text" class="form-control @error('make') is-invalid @enderror" :class="isInvalid('make')" name="make" id="make" placeholder="Alfa Romeo, BMW, Tesla...">
                        <div v-cloak v-if="errors.make.status" v-html="errors.make.message" class="invalid-feedback"></div>
                        @error('make')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="model">Model</label>
                        <input v-model="inputs.model" type="text" class="form-control @error('model') is-invalid @enderror" :class="isInvalid('model')" name="model" id="model" placeholder="Corola, Polo, X5...">
                        <div v-cloak v-if="errors.model.status" v-html="errors.model.message" class="invalid-feedback"></div>
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="registration">Broj tablica</label>
                        <input v-model="inputs.registration" type="text" class="form-control @error('registration_number') is-invalid @enderror" :class="isInvalid('registration')" name="registration_number" id="registration" placeholder="BG1234AB">
                        <div v-cloak v-if="errors.registration.status" v-html="errors.registration.message" class="invalid-feedback"></div>
                        @error('registration_number')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <button class="btn btn-warning w-100" :disabled="isDisabled">Dodaj</button>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <a href="/vehicles" class="btn btn-secondary w-100">Nazad</a>
                    </div>
                </div>
            </form>
        </vehicle-form>
    </div>
@endsection