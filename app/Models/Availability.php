<?php

namespace App\Models;

class Availability extends Model
{
    protected $fillable = ['user_id', 'available_date', 'start_time', 'end_time'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
