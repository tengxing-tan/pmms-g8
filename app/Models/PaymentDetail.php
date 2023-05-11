<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'id',
        'quantity',
        'total_price'
    ];

    // Declaring relationship between PaymentDetail and Payment
    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    // Declaring relationship between PaymentDetail and Item
    public function item() {
        return $this->belongsTo(Item::class);
    }
}
