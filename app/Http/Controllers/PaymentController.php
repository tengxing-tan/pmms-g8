<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;

class PaymentController extends Controller
{
    public function index() {

        return view('PaymentView.items', [
            'items' => Item::latest()->filter(request(['search']))->get()
        ]);
    }

    public function payment(Request $request) {
        $items = []; 
        $total_price = 0; 
        for($i = 1; $i < count($request->all()); $i++) {
            if($request[$i]>0){
                $item = Item::where('item_id', $i)->first(); 
                array_push($items, [$item, $request[$i]]);
                $total_price += $item->item_price * $request[$i];
            }
        }

        return view('PaymentView.payment', [
            "items" => $items, 
            "total_price" => $total_price
        ]);
    }

    public function receipt(Request $request) {
        $formFields = $request->validate([
            'payment_amount' => ['required', 'gte:total_price'],
        ]);
        
        $change = $request['payment_amount'] - $request['total_price'];

        Payment::create([
            'total_price' => $request['total_price'],
            'payment_method' => 'Cash', 
            'paid_amount' => $formFields['payment_amount'],
            'change' => $change
        ]);

        $payment_id = Payment::latest('payment_id')->first()->payment_id;
        $max_item = Item::latest('item_id')->first()->item_id;
        $items =[]; 
        for($i = 1; $i <= $max_item; $i++) {
            if($request[$i]>0){
                $item = Item::where('item_id', $i)->first(); 
                array_push($items, [$item, $request[$i]]);
                PaymentDetail::create([
                    'payment_id' => $payment_id, 
                    'item_id' => $i, 
                    'quantity' => $request[$i]
                ]);
            }
        }

        return view('PaymentView.receipt', [
            'total_price' => $request['total_price'],
            'payment_amount' => $formFields['payment_amount'],
            'change' => $change, 
            'items' => $items, 
            'payment' => Payment::latest('payment_id')->first()
        ]);
    }
}
