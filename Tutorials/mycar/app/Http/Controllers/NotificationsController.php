<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        $header = ["link" => "/", "icon" => "home"];
        return view('notifications.index', compact('header'));
    }

    public function fetch(){
        $notifications = Auth::user()->notifications()->simplePaginate(5);
        Auth::user()->notifications()->simplePaginate(5)->markAsRead();
        return response($notifications);
    }

    public function fetchUnread(){
        $notifications = Auth::user()->unreadNotifications()->simplePaginate(5);
        Auth::user()->unreadNotifications()->simplePaginate(5)->markAsRead();
        return response($notifications);
    }

    public function checkUnread(){
        $count = Auth::user()->unreadNotifications()->count();
        return response($count);
    }
}
