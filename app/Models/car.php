<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'transmission',
        'capacity',
        'price_per_day',
        'location',
        'image',
    ];
    
    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /** To check easily if my user can book a car with datess */
    public function isAvailable($startDate, $endDate)
    {
        return !$this->reservations()->where('start_date', '<=', $endDate)->where('end_date', '>=', $startDate)->exists();
    }

}