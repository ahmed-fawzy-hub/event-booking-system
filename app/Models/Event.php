<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'capacity',
    ];

    // علاقة: Event له حجوزات كثيرة
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // علاقة: Event له مستخدمون كثيرون من خلال الحجز
    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings');
    }
}
