<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        return view('PaymentView.items', ['items' => Item::latest()->filter(request(['search']))->paginate(10)]);
    }
}
