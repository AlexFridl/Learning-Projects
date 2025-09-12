@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="text-center mb-3">Statistike</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('helpers.admincard', ["text" => "Novih korisnika ove nedelje", "stat" => $newUsers, "sub" => $users])
            </div>
            <div class="col-lg-3 mb-4">
                @include('helpers.admincard', ["text" => "Novih vozila ove nedelje", "stat" => $newVehicles, "sub" => $vehicles])
            </div>
            <div class="col-lg-3 mb-4">
                @include('helpers.admincard', ["text" => "Novih delova ove nedelje", "stat" => $newParts, "sub" => $parts])
            </div>
            <div class="col-lg-3 mb-4">
                @include('helpers.admincard', ["text" => "Novih podsetnika ove nedelje", "stat" => $newReminders, "sub" => $reminders])
            </div>
        </div>
    </div>
@endsection