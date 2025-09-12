@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="text-center">Resetovanje lozinke</h1>
    </div>
    @if (session('status'))
        <div>
            <h4 class="text-success text-center">{{ session('status') }}</h4>
        </div>
    @endif
    <reset-email-form :model="{{json_encode(Session::getOldInput())}}" inline-template>
        <form @submit="validate" action="{{ route('password.email') }}" method="POST" class="mt-5">
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
            <div class="row mt-3">
                <div class="form-group col-lg-6 offset-lg-3">
                    <button class="btn btn-warning w-100" :disabled="isDisabled">Resetuj</button>
                </div>
            </div>
            <div class="row mt-1">
                <div class="form-group col-lg-6 offset-lg-3">
                    <a href="/login" class="btn btn-secondary w-100">Nazad</a>
                </div>
            </div>
        </form>
    </reset-email-form>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
