<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;

class ReportController extends Controller
{
    public function get_item_by_month($month, $year) {
        return Item::joinSub(PaymentDetail::whereYear("created_at", $year)->whereMonth("created_at", $month), 'payment_details', function($join) {
            $join->on('items.id', '=', 'payment_details.id'); 
        })->get()->toArray();
    }

    public function report() {
        $item_data = []; 
        $profit_data = [];
        $items = Item::all(); 
        $month = 1; 
        $year = date("Y");

        while($month <= 12) {
            $profit = 0;
            $payment_with_item = $this->get_item_by_month($month, $year);

            foreach($payment_with_item as $item) {
                $profit += ($item['quantity'] * $item['item_price']) - ($item['quantity'] * $item['unit_cost']);
            }

            array_push($profit_data, ["label" => date("F", mktime(0, 0, 0, $month, 1)), "y" => $profit]);
            $month++;
        }

        foreach($items as $item) {
            array_push($item_data, ["label" => $item->item_name, "y" => $item->quantity]); 
        }

        return view('ReportView.report', ['item_data'=> $item_data, 'profit_data' => $profit_data]);
    }
 }
