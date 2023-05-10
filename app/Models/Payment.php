<?php

namespace App\Models;

use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price', 
        'payment_method', 
        'paid_amount', 
        'change'
    ]; 
    
    // Declaring relationship between Payment and PaymentDetail
    public function payment_details() {
        return $this->hasMany(PaymentDetail::class, 'payment_id', 'payment_id');
    }
}
