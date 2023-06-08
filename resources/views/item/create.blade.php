<x-app-layout>
    <div class="p-6">
        <form class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg" action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" wire:submit.prevent="save">
            <h1 class="col-span-6 text-3xl font-semibold text-blue-800 mb-4">New Inventory</h1>
            @csrf

            <!-- input field -->
            <div class="grid grid-cols-6 gap-x-12 gap-y-6">
                <label for="item_name" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item name</span>
                    <input name="item_name" id="item_name" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" autofocus required />
                </label>
                <label for="brand" class="col-span-3 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Brand</span>
                    <input name="brand" id="brand" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" required />
                </label>
                <label for="quantity" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Quantity</span>
                    <input name="quantity" id="quantity" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" min="0" value="0" required />
                </label>
                <label for="unit_cost" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Unit cost</span>
                    <input name="unit_cost" id="unit_cost" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" min="0" value="0" required />
                </label>
                <label for="item_price" class="col-span-2 flex flex-col">
                    <span class="font-medium text-gray-700 mb-1">Item price</span>
                    <input name="item_price" id="item_price" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="number" min="0" value="0" required />
                </label>
                <!-- image upload -->
                <div class="col-span-3 flex flex-col items-start justify-center w-full">
                    <span class="font-medium text-gray-700 mb-1">Item picture</span>
                    <label for="item_photo_path" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input class="hidden" type="file" wire:model="photo" id="item_photo_path" name="item_photo_path">
                    </label>
                </div>
            </div>

            <!-- Save button -->
            <div class="flex py-6 space-x-4">
                <input type="submit" value="Save" class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded" />
                <a class="block cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded" href="{{ route('item.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>