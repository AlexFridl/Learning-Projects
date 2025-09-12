<header class="px-3 fixed">
    <nav class="row">
        <div class="d-lg-none col-4 text-left">
            @isset($header)
                @include('helpers.dynamic_header_icon', ["link" => $header['link'], "icon" => $header['icon']])
            @else 
            @include('helpers.dynamic_header_icon', ["link" => '/', "icon" => 'home'])
            @endisset
        </div>
        <div class="d-none d-lg-block d-xl-block col-4 text-left">
            <a href="/">
                <i class="mt-3 fas fa-home fa-lg"></i>
            </a>
        </div>
        <div class="col-4 d-flex justify-content-center">
            <a href="/">
                <img src="/img/mycar-logo.png" alt="MyCar Logo" style="height:45px" />
            </a>
        </div>
        @auth
        <div class="col-4 d-flex justify-content-end">
            <notifications-component></notifications-component>
            <menu-component @admin :admin="true" @endadmin></menu-component>
        </div>
        @endauth
    </nav>
</header>