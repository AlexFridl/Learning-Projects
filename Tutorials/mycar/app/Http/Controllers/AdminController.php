<?php

namespace App\Http\Controllers;

use App\Part;
use App\Reminder;
use App\User;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = User::all()->count();
        $vehicles = Vehicle::all()->count();
        $parts = Part::all()->count();
        $reminders = Reminder::all()->count();
        $newUsers = User::where('created_at', '>', Carbon::now()->subWeek()->toDateString())->count();
        $newVehicles = Vehicle::where('created_at', '>', Carbon::now()->subWeek()->toDateString())->count();
        $newParts = Part::where('created_at', '>', Carbon::now()->subWeek()->toDateString())->count();
        $newReminders = Reminder::where('created_at', '>', Carbon::now()->subWeek()->toDateString())->count();
        return view('admin', compact('newUsers', 'newVehicles', 'newParts', 'newReminders', 'users', 'vehicles', 'reminders', 'parts'));
    }
}
