<div class="drop-shadow-sm flex grid grid-cols-3 gap-4 items-center px-12 my-4 w-full">
    <div class="flex justify-start items-center">
        <img src="{{$item[0]->item_photo_path}}" alt="item photo" class="w-12 h-12 rounded-md">
        <span class="font-bold text-md pl-4">{{$item[0]->item_name}}</span>
        <input type="hidden" name="{{$item[0]->id}}" value="{{$item[1]}}" class="font-bold text-md pl-4"/>
    </div>
    <div class="font-bold text-md text-center">{{ $item[1] }}</div>
    <div class="items-center text-end"><span>RM </span>{{ $item[0]->item_price * $item[1] }}</div>
</div>  