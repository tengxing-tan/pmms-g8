<div class="relative mx-3">
    <div class="flex justify-center">
        <img src="{{$item->item_photo_path}}" alt="item image" class="w-38 h-38 rounded-lg">
    </div>
    <div class="flex width-full items-center justify-between px-2 mt-2">
        <span class="text-md font-bold">{{$item->item_name}}</span>
        <span class="text-sm text-grey">RM {{$item->item_price}}</span>
    </div>
    <div class="flex justify-center items center px-2 justify-between mt-2">
        <div class="rounded-full drop-shadow-sm px-4 py-2 border-2 border-gray-500 hover:border-1 hover:border-orange-200 active:border-orange-400">
            <button>-</button>
        </div>
        <input type="text" name="quantity" value="1" class="w-1/4 border-none justify-center focus:ring-orange-400">
        <div class="rounded-full drop-shadow-sm px-4 py-2 border-2 border-gray-500 hover:border-1 hover:border-orange-200 active:border-orange-400">
            <button>+</button>
        </div>
    </div>
    <span class="text-xs text-gray-400">stock: 20</span>
</div>