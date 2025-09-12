<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
    <div id="app">
        @include('partials.header')
        <main class="mt-5 pt-5 pb-4 text-center">
            <div class="mt-5">
                <h1 class="display-1">@yield('code')</h1>
                <h3>@yield('message')</h3>
            </div>
        </main>
    </div>
</body>
</html>
