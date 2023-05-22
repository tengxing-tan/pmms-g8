<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slot';

    protected $fillable = [
        'start_slot',
        'end_slot',
        'daily_roster_id',
    ];

    public function dailyRoster()
    {
        return $this->belongsTo(DailyRoster::class);
    }

}
