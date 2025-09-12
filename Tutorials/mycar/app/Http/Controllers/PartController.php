<?php

namespace App\Http\Controllers;

use App\Part;
use App\Vehicle;
use App\PartType;
use Illuminate\Http\Request;
use App\Http\Requests\PartStoreRequest;
use App\Http\Requests\PartUpdateRequest;
use Exception;

class PartController extends Controller
{
    public function fetch(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $parts = $vehicle->parts()->with('partType');
        if (request()->has('type')) {
            $parts = Part::typeFilter($parts, request()->type);
        }
        if (request()->has('change')) {
            $parts = Part::changeFilter($parts, request()->change);
        }
        if (request()->has('sort')) {
            $parts = Part::sort($parts, request()->sort);
        }
        $parts = $parts->simplePaginate(5)->appends(request()->query());
        return response($parts);
    }
    
    public function index(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $header = ["link" => "/vehicles/" . $vehicle->id, "icon" => "chevron-left"];
        $partTypes = PartType::all();
        if($vehicle->parts()->count() == 0){
            return redirect('/vehicles/' . $vehicle->id);
        }
        return view('parts.index', compact('vehicle', 'partTypes', 'header'));
    }

    public function create(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $header = ["link" => "/vehicles/" . $vehicle->id . '/parts', "icon" => "chevron-left"];
        $partTypes = PartType::all();
        return view('parts.create', compact('vehicle', 'partTypes', 'header'));
    }

    public function store(PartStoreRequest $request, Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        try {
            $vehicle->parts()->create($request->all());
            return redirect('/vehicles/' . $vehicle->id . '/parts');
        } catch(Exception $e){
            return redirect('/vehicles/' . $vehicle->id . '/parts/create')->with('errorMessage', "Došlo je do greške.")->withInput();
        }
    }

    public function show(Vehicle $vehicle, Part $part)
    {
        $this->authorize('owner', [$part->vehicle]);
        $header = ["link" => "/vehicles/" . $vehicle->id . '/parts', "icon" => "chevron-left"];
        $part->load('partType');
        $partTypes = PartType::all();
        return view('parts.show', compact('vehicle', 'part', 'partTypes', 'header'));
    }

    public function edit(Part $part)
    {
        $this->authorize('owner', [$part->vehicle]);
        return view('parts.edit', compact('part'));
    }

    public function update(PartUpdateRequest $request, Vehicle $vehicle, Part $part)
    {
        $this->authorize('owner', [$part->vehicle]);
        try {
            $part->update($request->all());
            $part->load('partType');
            return response($part);
        } catch (Exception $e){
            return response(["errorMessage" => "Došlo je do greške."], 500);
        }
    }

    public function destroy(Vehicle $vehicle, Part $part)
    {
        $this->authorize('owner', [$part->vehicle]);
        try {
            $part->delete();
            return redirect('/vehicles/' . $vehicle->id . '/parts');
        } catch (Exception $e){
            return redirect('/vehicles/' . $vehicle->id . '/parts/' . $part->id)->with("errorMessage", "Došlo je do greške.");
        }
    }
}
