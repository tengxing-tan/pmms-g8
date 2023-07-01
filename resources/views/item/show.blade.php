<x-app-layout>
    <div class="p-6" x-data="{ openDelConfirm: false }">
        <div class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg">
            <!-- section title & delete button -->
            <div class="grid grid-cols-12 items-center w-full">
                <h1 class="col-span-6 text-3xl font-semibold text-gray-800 mb-4">View Inventory</h1>
                <button class="col-span-6 justify-self-end block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor" type="button" x-on:click="openDelConfirm = true">Delete</button>
            </div>
            <form action="{{ route('item.destroy', $item->id) }}" method="POST" x-show="openDelConfirm">
                @csrf
                @method('DELETE')
                <div class="absolute top-0 bottom-0 left-0 right-0 flex justify-center items-center">
                    <div class="bg-white rounded shadow-2xl shadow-gray-500/50 p-12 px-24 flex flex-col items-center">
                        <p class="text-xl font-bold text-gray-800 mb-6">Confirm to delete?</p>
                        <div class="flex">
                            <input type="submit" value="Delete" class="block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor" />
                            <button class="block ml-4 cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded" type="button" x-on:click="openDelConfirm = false">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- input field -->
            <div class="grid grid-cols-6 gap-x-12 gap-y-6">
                <label for="item_name" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item name</span>
                    <input name="item_name" value="{{ $item->item_name }}" id="item_name" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" disabled />
                </label>
                <label for="brand" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Brand</span>
                    <input name="brand" id="brand" value="{{ $item->brand }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" disabled />
                </label>
                <label for="quantity" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Quantity</span>
                    <input name="quantity" id="quantity" value="{{ $item->quantity }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" min="0" value="0" disabled />
                </label>
                <label for="unit_cost" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Unit cost</span>
                    <input name="unit_cost" id="unit_cost" value="{{ $item->unit_cost }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" step="0.01" min="0" value="0" disabled />
                </label>
                <label for="item_price" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item price</span>
                    <input name="item_price" id="item_price" value="{{ $item->item_price }}" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" step="0.01" min="0" value="0" disabled />
                </label>
                <!-- image upload -->
                <div class="col-span-3 flex flex-col items-start justify-center w-full">
                    <span class="font-medium text-gray-700 mb-1">Item picture</span>
                    <!-- <label for="item_photo_path" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input class="hidden" type="file" wire:model="photo" id="item_photo_path" name="item_photo_path">
                    </label> -->
                    @php
                    $img_path = asset($item->item_photo_path)
                    @endphp
                    <img src="{{ $img_path }}" alt="{{ $img_path }}">
                </div>
            </div>

            <!-- Action button -->
            <div class="flex py-6 space-x-4">
                <a href="{{ route('item.edit', $item->id) }}">
                    <div class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded">Edit</div>
                </a>
                <a class="block cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded" href="{{ route('item.index') }}">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>