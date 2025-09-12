<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reminder extends Model
{
    protected $fillable = ['date', 'description', 'price', 'notify_email', 'notify_days', 'vehicle_id'];

    protected $appends = ['formattedDate', 'formattedPrice', 'expiresSoon', 'expired'];

    public static function expiresSoonFilter($query, $expiresSoon)
    {
        switch ($expiresSoon) {
            case 0:
                return $query->whereRaw('notify_days < DATEDIFF(date, CURRENT_TIMESTAMP)');
                break;
            case 1:
                return $query->whereRaw('notify_days >= DATEDIFF(date, CURRENT_TIMESTAMP) AND DATEDIFF(date, CURRENT_TIMESTAMP) >= 0');
                break;
            case 2:
                return $query;
                break;
            case 3:
                return $query->where('date', '<', Carbon::now());
                break;
        }
    }

    public static function notifyFilter($query, $notify)
    {
        if ($notify == 2) {
            return $query;
        }
        return $query->where('notify_email', $notify);
    }

    public static function sort($query, $sort)
    {
        switch ($sort) {
            case '0':
                return $query->orderByRaw('(DATEDIFF(date, CURRENT_TIMESTAMP) > 0) DESC')->orderBy('date', 'asc');
            case '1':
                return $query->orderByRaw('(DATEDIFF(date, CURRENT_TIMESTAMP) > 0) DESC')->orderBy('date', 'desc');
        }
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getFormattedDateAttribute()
    {
        return date("d.m.Y.", strtotime($this->date));
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ",", ".") . ' RSD';
    }

    public function getDaysBeforeExpiryAttribute()
    {
        return strtotime($this->date) - strtotime(Carbon::now());
    }

    public function getExpiresSoonAttribute()
    {
        return $this->daysBeforeExpiry <= $this->attributes['notify_days'] * 86400 && $this->daysBeforeExpiry >= 0;
    }

    public function getExpiredAttribute()
    {
        return strtotime($this->date) < strtotime(Carbon::now());
    }

    public function scopeStandardSorting($query)
    {
        return $query->orderByRaw('(DATEDIFF(date, CURRENT_TIMESTAMP) > 0) DESC')->orderBy('date', 'asc');
    }

    public function setNotifyEmailAttribute($value){
        if($value == 'on'){
            $this->attributes['notify_email'] = 1;
        } else {
            $this->attributes['notify_email'] = $value;
        }

    }
}
