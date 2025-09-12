<?php

namespace App\Policies;

use App\User;
use App\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function owner(User $user, Vehicle $vehicle)
    {
        return $user->id === $vehicle->user_id;
    }
}
