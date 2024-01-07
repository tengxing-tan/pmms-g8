<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;

class PaymentController extends Controller
{
    public function items()
    {

        return view('PaymentView.items', [
            'items' => Item::filter(request(['search']))->get()
        ]);
    }

    public function payment(Request $request)
    {
        $items = [];
        $total_price = 0;

        // Issue in the loop cause the error when search due to items ID not be consecutive.
        // Loop through all items and check if the quantity is greater than 0
        foreach ($request->all() as $key => $value) {
            if (is_numeric($key) && $value > 0) {
                $item = Item::find($key);

                if ($item) {
                    array_push($items, [$item, $value]);
                    $total_price += $item->item_price * $value;
                }
            }
        }

        if (count($items) == 0) {
            return back()->with('error', 'Please select at least one item');
        }

        return view('PaymentView.payment', [
            'items' => $items,
            'total_price' => $total_price
        ]);
    }

    public function receipt(Request $request)
    {
        $formFields = $request->validate([
            "paid_amount" => 'required'
        ]);

        $change = $request['paid_amount'] - $request['total_price'];

        Payment::create([
            'total_price' => $request['total_price'],
            'payment_method' => 'Cash',
            'paid_amount' => $formFields['paid_amount'],
            'change' => $change
        ]);

        $payment_id = Payment::latest('payment_id')->first()->payment_id;
        $max_item = Item::latest('id')->first()->id;
        $items = [];

        for ($i = 1; $i <= $max_item; $i++) {
            if ($request[$i] > 0) {
                $item = Item::where('id', $i)->first();
                array_push($items, [$item, $request[$i]]);
                PaymentDetail::create([
                    'payment_id' => $payment_id,
                    'id' => $i,
                    'quantity' => $request[$i]
                ]);
                Item::where('id', $i)->update(['quantity' => $item->quantity - $request[$i]]);
            }
        }

        $payment = Payment::latest('payment_id')->first();

        return view('PaymentView.receipt', [
            'total_price' => $request['total_price'],
            'paid_amount' => $formFields['paid_amount'],
            'change' => round($change, 2),
            'items' => $items,
            'payment' => $payment,
        ]);
    }
}
