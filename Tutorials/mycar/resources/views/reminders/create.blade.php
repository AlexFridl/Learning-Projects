@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="text-center">Dodajte podsetnik</h1>
        </div>
        <reminder-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
            <form @submit="validate" action="/vehicles/{{$vehicle->id}}/reminders" method="POST" class="mt-5">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="description">Opis</label>
                        <input v-model="inputs.description" type="text" class="form-control @error('description') is-invalid @enderror" :class="isInvalid('description')" name="description" id="description" placeholder="Praking za mart, registracija...">
                        <div v-cloak v-if="errors.description.status" v-html="errors.description.message" class="invalid-feedback"></div>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="date">Datum</label>
                        <input v-model="inputs.date" type="date" class="form-control @error('date') is-invalid @enderror" :class="isInvalid('date')" name="date" id="date">
                        <div v-cloak v-if="errors.date.status" v-html="errors.date.message" class="invalid-feedback"></div>
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="price">Cena</label>
                        <div class="input-group">
                            <input v-model="inputs.price" type="text" class="form-control @error('price') is-invalid @enderror" :class="isInvalid('price')" name="price" id="price">
                            <div class="input-group-append">
                                <span class="input-group-text">RSD</span>
                            </div>
                        </div>
                        <div v-cloak v-if="errors.price.status" v-html="errors.price.message" class="invalid-feedback"></div>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="notifyDays">Obavesti me ranije</label>
                        <div class="input-group">
                            <input v-model="inputs.notifyDays" type="text" class="form-control @error('notify_days') is-invalid @enderror" :class="isInvalid('notifyDays')" name="notify_days" id="notifyDays">
                            <div class="input-group-append">
                                <span class="input-group-text">dan(a)</span>
                            </div>
                        </div>
                        <div v-cloak v-if="errors.notifyDays.status" v-html="errors.notifyDays.message" class="invalid-feedback"></div>
                        @error('notify_days')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-6 offset-lg-3">
                        <input v-model="inputs.notifyEmail" class="@error('notfiy_email') is-invalid @enderror" type="checkbox" name="notify_email" id="notifyEmail">
                        <label class="" for="notifyEmail">
                        Obaveštenje preko email-a
                        </label>
                        <div v-cloak v-if="errors.notifyEmail" v-html="errors.notifyEmail.message" class="invalid-feedback"></div>
                        @error('notify_email')
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
                        <a href="/vehicles/{{$vehicle->id}}/reminders" class="btn btn-secondary w-100">Nazad</a>
                    </div>
                </div>
            </form>
        </reminder-form>
    </div>
@endsection