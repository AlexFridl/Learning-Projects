<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    protected $fillable = ['registration_number', 'make', 'model', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function getShortModelAttribute(){
        return Str::limit($this->attributes['model'], 10, '...');
    }
}
