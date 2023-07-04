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
        'id', 
        'item_name',
        'brand',
        'quantity',
        'item_photo_path',
        'unit_cost',
        'item_price'
    ];

    public function payment_details() {
        return $this->hasMany(PaymentDetail::class, 'id', 'id');
    }

    public function inventories() {
        return $this->hasMany(Inventory::class, 'id', 'id');
    }

    public function scopeFilter($query, array $filters) {
        if ($filters['search'] ?? false) {
            $query->where('item_name', 'like', '%'. request('search'). '%'); 
        }            // $query->where('id', 'like', '%', request('id'), '%'); 
    }

    public function scopegetItem($id) {
        return Item::where('id', $id)->first();
    }
}
