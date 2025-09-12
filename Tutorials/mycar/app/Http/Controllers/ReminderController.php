<?php

namespace App\Http\Controllers;

use App\Reminder;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\ReminderStoreRequest;
use App\Http\Requests\ReminderUpdateRequest;
use Exception;

class ReminderController extends Controller
{
    public function fetch(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $reminders = $vehicle->reminders();
        if (request()->has('expiresSoon')) {
            $reminders = Reminder::expiresSoonFilter($reminders, request()->expiresSoon);
        }
        if (request()->has('notify')) {
            $reminders = Reminder::notifyFilter($reminders, request()->notify);
        }
        if (request()->has('sort')) {
            $reminders = Reminder::sort($reminders, request()->sort);
        }
        $reminders = $reminders->simplePaginate(5)->appends(request()->query());
        return response($reminders);
    }
    
    public function index(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $header = ["link" => "/vehicles/" . $vehicle->id, "icon" => "chevron-left"];
        if($vehicle->reminders()->count() == 0){
            return redirect('/vehicles/' . $vehicle->id);
        }
        return view('reminders.index', compact('vehicle', 'header'));
    }

    public function create(Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        $header = ["link" => "/vehicles/" . $vehicle->id . '/reminders', "icon" => "chevron-left"];
        return view('reminders.create', compact('vehicle', 'header'));
    }

    public function store(ReminderStoreRequest $request, Vehicle $vehicle)
    {
        $this->authorize('owner', $vehicle);
        try{
            $vehicle->reminders()->create($request->all());
            return redirect('/vehicles/' . $vehicle->id . '/reminders');
        } catch (Exception $e){
            return redirect('/vehicles/' . $vehicle->id . '/reminders/create')->with("errorMessage", "Došlo je do greške.")->withInput();
        }
    }

    public function show(Vehicle $vehicle, Reminder $reminder)
    {
        $this->authorize('owner', [$reminder->vehicle]);
        $header = ["link" => "/vehicles/" . $vehicle->id . '/reminders', "icon" => "chevron-left"];
        return view('reminders.show', compact('vehicle', 'reminder', 'header'));
    }

    public function edit(Reminder $reminder)
    {
        //
    }

    public function update(ReminderUpdateRequest $request, Vehicle $vehicle, Reminder $reminder)
    {
        $this->authorize('owner', [$reminder->vehicle]);
        try {
            $reminder->update($request->all());
            return response($reminder);
        } catch (Exception $e){
            return response(["errorMessage" => "Došlo je do greške."], 500);
        }
    }

    public function destroy(Vehicle $vehicle, Reminder $reminder)
    {
        $this->authorize('owner', [$reminder->vehicle]);
        try {
            $reminder->delete();
            return redirect('/vehicles/' . $vehicle->id . '/reminders');
        } catch (Exception $e){
            return redirect('/vehicles/' . $vehicle->id . '/reminders/' . $reminder->id)->with("errorMessage", "Došlo je do greške.");
        }
    }
}
