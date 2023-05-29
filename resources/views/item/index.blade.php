<x-app-layout>

    <div class="p-6 w-full max-w-4xl mx-auto" x-data="{ openPopMesg: true }">
        <!-- success message -->
        @if ($message = Session::get('success'))
        <div class="px-4 py-2 mb-4 flex justify-between items-center w-full bg-green-400 text-gray-50 font-bold" x-show="openPopMesg" x-transition>
            <p>{{ $message  }}</p>
            <button class="flex items-center" x-on:click="openPopMesg = false">
                <span class="material-symbols-outlined font-medium">close</span>
            </button>
        </div>
        @endif

        <div class="grid grid-cols-12 items-center w-full">
            <h1 class="col-span-6 text-3xl font-semibold text-gray-800"><a href="{{ route('item.index') }}">{{ $title }}</a></h1>
            <div class="col-span-6 justify-self-end">
                <a class="py-2 px-4 rounded bg-amber-500 hover:bg-amber-700 font-medium text-white cursor" href="{{ route('item.create') }}"> Create New inventory</a>
            </div>
        </div>
    </div>

    <div class="p-6 w-full max-w-4xl mx-auto bg-white text-gray-700 rounded-lg">
        <!-- search bar -->
        <form class="flex justify-end" action="{{ route('item.filter') }}" method="GET">
            <div class="flex items-center w-56 rounded bg-gray-100 px-2">
                <span class="material-symbols-outlined">search</span>
                <input class="bg-transparent text-sm focus:ring-0 focus:font-medium border-none w-full" type="text" name="search" id="search" placeholder="Search item name">
            </div>
        </form>

        <!-- table header -->
        <div class="grid grid-cols-12 place-items-center bg-gray-100 px-4 rounded-md mt-8 font-semibold text-gray-800">
            <div class="col-span-1 p-2">No</div>
            <div class="col-span-2 p-2">Item Name</div>
            <div class="col-span-2 p-2">Brand</div>
            <div class="col-span-2 p-2">Quantity</div>
            <div class="col-span-2 p-2">Unit cost</div>
            <div class="col-span-2 p-2">Item price</div>
            <div class="col-span-1 p-2">Action</div>
        </div>

        <!-- table body -->

        @foreach ($items as $item)

        <div class="px-4 flex flex-col space-y-2">
            <div class="grid grid-cols-12 place-items-center border-b">
                <div class="col-span-1 p-2">
                    {{ ++$i }}
                </div>
                <div class="col-span-2 p-2">
                    {{ $item->item_name }}
                </div>
                <div class="col-span-2 p-2">
                    {{ $item->brand }}
                </div>
                <div class="col-span-2 p-2">
                    {{ $item->quantity }}
                </div>
                <div class="col-span-2 p-2">
                    {{ $item->unit_cost }}
                </div>
                <div class="col-span-2 p-2">
                    {{ $item->item_price }}
                </div>
                <div class="col-span-1 p-2">
                    <a class="block cursor-pointer px-2 py-1 border text-amber-500 hover:bg-amber-500 hover:text-white font-medium rounded" href="{{ route('item.show', $item->id) }}">Show</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{--
    <form action="{{ route('inventory.destroy',$inventory->inventory_id) }}" method="POST">

    <a class="btn btn-primary" href="{{ route('inventory.edit',$inventory->inventory_id) }}">Edit</a>
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">Delete</button>
    </form>
    --}}
</x-app-layout>
