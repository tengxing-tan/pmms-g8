<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $items = Item::with('inventories')->filter(request(['search']))->paginate(10);
        $inventories = Inventory::with('item')->get();

        return view('PaymentView.items', compact('items', 'inventories'));
    }
}
