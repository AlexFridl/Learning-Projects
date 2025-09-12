<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use Exception;

class VehicleController extends Controller
{
    public function index()
    {
        $header = ["link" => "/", "icon" => "home"];
        $vehicles = Auth::user()->vehicles()->get();
        return view('vehicles.index', compact('vehicles', 'header'));
    }

    public function create()
    {
        if(Auth::user()->vehicles()->count() >= 10){
            return redirect('/vehicles')->with("errorMessage", "Imate maksimalan broj vozila.");
        }
        $header = ["link" => "/vehicles", "icon" => "chevron-left"];
        return view('vehicles.create', compact('header'));
    }

    public function store(VehicleStoreRequest $request)
    {
        if(Auth::user()->vehicles()->count() >= 10){
            return redirect('/vehicles')->with("errorMessage", "Imate maksimalan broj vozila.");
        }
        try {
            $vehicle = Auth::user()->vehicles()->create($request->all());
            return redirect('/vehicles/' . $vehicle->id);
        } catch (Exception $e){
            return redirect('/vehicles/create')->with("errorMessage", "Došlo je do greške.")->withInput();

        }
    }

    public function show(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $header = ["link" => "/vehicles", "icon" => "chevron-left"];
        $parts = $vehicle->parts()->standardSorting()->limit(3)->get();
        $reminders = $vehicle->reminders()->standardSorting()->limit(3)->get();
        return view('vehicles.show', compact('vehicle', 'parts', 'reminders', 'header'));
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorize('owner', [$vehicle]);
        $header = ["link" => "/vehicles/" . $vehicle->id, "icon" => "chevron-left"];
        return view('vehicles.edit', compact('vehicle', 'header'));
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $this->authorize('owner', [$vehicle]);
        try {
            $vehicle->update($request->all());
            return response($vehicle);
        } catch (Exception $e){
            return response(["errorMessage" => "Došlo je do greške."], 500);
        }   
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('owner', [$vehicle]);
        try {
            $vehicle->delete();
            return redirect('/vehicles');
        } catch(Exception $e){
            return redirect('/vehicles/' . $vehicle->id)->with("errorMessage", "Došlo je do greške.");
        }
    }
}
