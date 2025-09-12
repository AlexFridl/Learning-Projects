<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
    <div id="app">
        @include('partials.header')
        <main class="mt-4 pt-5 pb-4">
            @yield('content')
        </main>
        @if (session('successMessage'))
            <success-alert message="{{session('successMessage')}}"></success-alert>
        @endif
        @if (session('errorMessage'))
            <error-alert message="{{session('errorMessage')}}"></error-alert>
        @endif
    </div>
</body>
</html>
