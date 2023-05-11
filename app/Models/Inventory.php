<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'id', 
        'opening_quantity',
        'closing_quantity',
        'current_quantity',
        'comment'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id', 'id');
    }

    // public function daily_roster(): HasOne
    // {
    //     return $this->hasOne(DailyRoster::class);
    // }
}
