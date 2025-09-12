<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['name', 'date', 'mileage', 'part_type_id', 'change', 'price', 'vehicle_id'];

    protected $appends = ["formattedMileage", "formattedDate", "formattedPrice"];

    public static function typeFilter($query, $type)
    {
        if ($type == 0) {
            return $query;
        }
        return $query->where('part_type_id', $type);
    }

    public static function changeFilter($query, $change)
    {
        if ($change == 2) {
            return $query;
        }
        return $query->where('change', $change);
    }

    public static function sort($query, $sort)
    {
        switch ($sort) {
            case '0':
                return $query->orderBy('change', 'desc')->orderBy('date', 'asc');
            case '1':
                return $query->orderBy('change', 'asc')->orderBy('date', 'asc');
            case '2':
                return $query->orderBy('date', 'desc');
            case '3':
                return $query->orderBy('date', 'asc');
        }
    }

    public function partType()
    {
        return $this->belongsTo(PartType::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getFormattedMileageAttribute()
    {
        return number_format($this->mileage, 0, ",", ".") . " km";
    }

    public function getFormattedDateAttribute()
    {
        return date("d.m.Y.", strtotime($this->date));
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ",", ".") . ' RSD';
    }

    public function scopeStandardSorting($query)
    {
        return $query->orderBy('change', 'desc')->orderBy('date', 'asc');
    }
}
