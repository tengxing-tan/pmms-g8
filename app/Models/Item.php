<?php

namespace App\Models;

use App\Models\Inventory;
use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 
        'item_name',
        'brand',
        'item_photo_path',
        'unit_cost',
        'item_price'
    ];

    public function payment_details() {
        return $this->hasMany(PaymentDetail::class, 'item_id', 'item_id');
    }

    public function inventories() {
        return $this->hasMany(Inventory::class, 'item_id', 'item_id');
    }

    public function scopeFilter($query, array $filters) {
        if ($filters['search'] ?? false) {
            $query->where('item_name', 'like', '%', request('search'), '%'); 
        }            // $query->where('item_id', 'like', '%', request('item_id'), '%'); 
    }

    public function scopegetItem($item_id) {
        return Item::where('item_id', $item_id)->first();
    }
}
