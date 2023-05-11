<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(5);
        return view('item.index', compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('item.index')->with('inventories', $inventories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|max:255',
            'brand' => 'required|max:255',
            'quantity' => 'required|min:0',
            'unit_cost' => 'required|min:0',
            'item_price' => 'required|min:0',
        ]);
        // $newItem = Item::create($request->all());
        // dd($newItem);

        return redirect()->route('item.index', Item::create($request->all()))
            ->with('success', 'Inventory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_name' => 'required|max:255',
            'brand' => 'required|max:255',
            'quantity' => 'required|min:0',
            'unit_cost' => 'required|min:0',
            'item_price' => 'required|min:0',
        ]);

        $item->update($request->all());

        return redirect()->route('item.index')
            ->with('success', 'Inventory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // dd($item);
        $item->delete();

        return redirect()->route('item.index')
            ->with('success', 'Inventory deleted successfully');
    }
}
