<x-app-layout>
    <div class="p-6">
        <form class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg" action="{{ route('item.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="col-span-6 text-3xl font-semibold text-gray-800 mb-4">Edit Inventory</h1>
            <!-- input field -->
            <div class="grid grid-cols-6 gap-x-12 gap-y-6">
                <label for="item_name" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item name</span>
                    <input name="item_name" value="{{ $item->item_name }}" id="item_name" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" autofocus />
                </label>
                <label for="brand" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Brand</span>
                    <input name="brand" id="brand" value="{{ $item->brand }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" />
                </label>
                <label for="quantity" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Quantity</span>
                    <input name="quantity" id="quantity" value="{{ $item->quantity }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" min="0" value="0" />
                </label>
                <label for="unit_cost" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Unit cost</span>
                    <input name="unit_cost" id="unit_cost" value="{{ $item->unit_cost }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" step="0.01" min="0" value="0" />
                </label>
                <label for="item_price" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item price</span>
                    <input name="item_price" id="item_price" value="{{ $item->item_price }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" step="0.01" min="0" value="0" />
                </label>
                <label for="img_photo_path" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item picture</span>
                    <div class="w-full h-56 flex justify-center items-center bg-gray-100 rounded-lg">
                        <span class="text-gray-300 font-medium text-xl">Upload item picture</span>
                    </div>
                    <input class="hidden" type="file" id="img_photo_path" name="img_photo_path" accept="image/*">
                </label>
            </div>

            <!-- Save button -->
            <div class="flex py-6 space-x-4">
                <input type="submit" value="Edit" class="bg-amber-500 text-white font-medium p-2 px-4 rounded" />
                <a class="block cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded" href="{{ route('item.index') }}">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>