<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\ProfileUpdateRequest;
use Exception;

class ProfileController extends Controller
{
    public function edit(){
        $header = ["link" => "/", "icon" => "home"];
        return view('profile.edit', compact('header'));
    }

    public function update(ProfileUpdateRequest $request){
        $user = User::find(Auth::user()->id);
        if($request->has('email')){
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        try {
            $user->save();
            return redirect('/profile')->with(["successMessage" => "Uspešna izmena."]);
        } catch (Exception $e){
            return redirect('/profile')->with(["errorMessage" => "Došlo je do greške."]); 
        }
    }
}
