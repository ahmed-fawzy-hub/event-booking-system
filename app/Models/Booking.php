<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
    ];

    // علاقة: الحجز ينتمي لمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة: الحجز ينتمي لفعالية
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
