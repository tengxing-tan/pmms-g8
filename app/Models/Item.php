<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function paymentDetails() {
        return $this->hasMany(PaymentDetail::class, 'item_id');
    }

    public function scopeFilter($query, array $search) {
        if ($search['search'] ?? false) {
            $query->where('item_name', 'like', '%', request('search'), '%'); 
        }
    }
}
