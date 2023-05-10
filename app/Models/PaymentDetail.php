<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'item_id',
        'quantity',
        'total_price'
    ];

    public function payment() {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
