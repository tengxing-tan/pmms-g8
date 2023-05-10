<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Declaring relationship between Payment and PaymentDetail
    public function payment_details() {
        return $this->hasMany(PaymentDetail::class, 'payment_id');
    }
}
