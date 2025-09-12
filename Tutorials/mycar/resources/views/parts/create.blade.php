@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="text-center">Dodajte deo</h1>
        </div>
        <part-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
            <form @submit="validate" action="/vehicles/{{$vehicle->id}}/parts" method="POST" class="mt-5">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="partTypeId">Vrsta dela</label>
                        <select v-model="inputs.partTypeId" class="custom-select @error('part_type_id') is-invalid @enderror" :class="isInvalid('partTypeId')" name="part_type_id" id="partTypeId">
                          <option value="0">Izaberite...</option>
                          @foreach($partTypes as $partType)
                            <option value="{{$partType->id}}">{{$partType->name}}</option>
                          @endforeach
                        </select>
                        <div v-cloak v-if="errors.partTypeId.status" v-html="errors.partTypeId.message" class="invalid-feedback"></div>
                        @error('part_type_id')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                      </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <label for="name">Naziv</label>
                        <input v-model="inputs.name" type="text" class="form-control @error('name') is-invalid @enderror" :class="isInvalid('name')" name="name" id="name" placeholder="Anlaser, Prednja leva guma...">
                        <div v-cloak v-if="errors.name.status" v-html="errors.name.message" class="invalid-feedback"></div>
                        @error('name')
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
                        <label for="mileage">Kilometraža</label>
                        <div class="input-group">
                            <input v-model="inputs.mileage" type="text" class="form-control @error('mileage') is-invalid @enderror" :class="isInvalid('mileage')" name="mileage" id="mileage">
                            <div class="input-group-append">
                                <span class="input-group-text">km</span>
                            </div>
                        </div>
                        <div v-cloak v-if="errors.mileage.status" v-html="errors.mileage.message" class="invalid-feedback"></div>
                        @error('mileage')
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
                <div class="row mt-3">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <button class="btn btn-warning w-100" :disabled="isDisabled">Dodaj</button>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="form-group col-lg-6 offset-lg-3">
                        <a href="/vehicles/{{$vehicle->id}}/parts" class="btn btn-secondary w-100">Nazad</a>
                    </div>
                </div>
            </form>
        </part-form>
    </div>
@endsection