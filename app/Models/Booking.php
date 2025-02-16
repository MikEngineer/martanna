<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'date', 'status', 'payment_intent_id', 'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
