<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'opening_quantity',
        'closing_quantity',
        'current_quantity',
        'comment'
    ];

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    // public function daily_roster(): HasOne
    // {
    //     return $this->hasOne(DailyRoster::class);
    // }
}
