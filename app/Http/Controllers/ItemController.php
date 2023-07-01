<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowStockAlert = Item::where('quantity', '<', 10)->get();

        $items = Item::latest()->paginate(5);
        return view('item.index', compact('items'))
            ->with('i', 0)
            ->with('title', 'Item List')
            ->with('lowStockAlert', $lowStockAlert);
        // ->with('i', (request()->input('page', 1) - 1) * 5);
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
        // Laravel docs: File Uploads
        if ($request->item_photo_path->isValid()) 
        {
            $path = $request->item_photo_path->store('item_photos');
        } else {
            
            return redirect()->back()->with('error', 'Invalid file type.');
        }

        $request->validate([
            'item_name' => 'required|max:255',
            'brand' => 'required|max:255',
            'quantity' => 'required|min:0',
            'unit_cost' => 'required|min:0',
            'item_price' => 'required|min:0',
        ]);

        return redirect()->route('item.index', Item::create([
            'item_name' => $request->input('item_name'),
            'brand' => $request->input('brand'),
            'quantity' => $request->input('quantity'),
            'unit_cost' => $request->input('unit_cost'),
            'item_price' => $request->input('item_price'),
            'item_photo_path' => $path,
        ]))->with('success', 'Inventory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // $path = Storage::path($item->item_photo_path);
        // dd($path);
        return view('item.show', compact('item'));
        // ->with('path', $path);
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
        $path = Storage::putFile('public/item_photos', $request->file('item_photo_path'));
        $path = 'storage/' . substr($path, 7);
        $request->validate([
            'item_name' => 'required|max:255',
            'brand' => 'required|max:255',
            'quantity' => 'required|min:0',
            'unit_cost' => 'required|min:0',
            'item_price' => 'required|min:0',
        ]);

        return redirect()->route('item.index', Item::create([
            'item_name' => $request->input('item_name'),
            'brand' => $request->input('brand'),
            'quantity' => $request->input('quantity'),
            'unit_cost' => $request->input('unit_cost'),
            'item_price' => $request->input('item_price'),
            'item_photo_path' => $path,
        ]))->with('success', 'Inventory created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        $path = 'public/' . substr($item->item_photo_path, 8);
        $delFile = Storage::delete($path);
        // dd([$delFile, $path]);

        // Storage::delete($item->item_photo_path);

        return redirect()->route('item.index')
            ->with('success', 'Inventory deleted successfully');
    }

    /**
     * Filter the specified resource from storage.
     */
    public function filter(Request $request)
    {
        $items = Item::where('item_name', 'like', $request->input('search') . '%')
            ->orWhere('brand', 'like', $request->input('search') . '%')
            ->orderBy('item_name')
            ->take(10)
            ->get();

        return view('item.index', compact('items'))
            ->with('i', 0)
            ->with('title', 'Filter Item');
    }
}
