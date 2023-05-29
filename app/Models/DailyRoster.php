<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRoster extends Model
{
    use HasFactory;
    protected $fillable = [
        'roster_date',
        'roster_start_time',
        'roster_end_time',
    ];
    public function weeklyRoster()
    {
        return $this->belongsTo(WeeklyRoster::class);
    }

    public function slot()
    {
        return $this->hasMany(Slot::class);
    }

}
