<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyRoster extends Model
{
    protected $table = 'weekly_rosters';
    use HasFactory;

    public function dailyRosters()
    {
        return $this->hasMany(DailyRoster::class);
    }
}
