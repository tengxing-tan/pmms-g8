<div class="relative mx-3">
    <div class="flex justify-center">
        <img src="{{ asset($item->item_photo_path) }}" alt="item image" class="w-38 h-38 rounded-lg">
    </div>
    <div class="flex width-full items-center justify-between px-2 mt-2">
        <span class="text-md font-bold">{{$item->item_name}}</span>
        <span class="text-sm text-grey">RM {{$item->item_price}}</span>
    </div>
    <div class="flex justify-center items-center px-2 justify-between mt-2" x-data="counter({{$item->quantity}})">
        <div class="rounded-full drop-shadow-sm px-3 py-2 border-2 border-gray-500 hover:border-1 hover:border-orange-200 active:border-orange-400">
                <button type="button" x-on:click="decrement()">-</button>
        </div>
        <input type="text" readonly name="{{$item->id}}" x-bind:value="count" class="w-1/4 border-none text-center focus:ring-orange-400"/>
        <div class="rounded-full drop-shadow-sm py-2 px-3 border-2 border-gray-500 hover:border-1 hover:border-orange-200 active:border-orange-400">
            <button type="button" x-on:click="increment()">+</button>
        </div>
    </div>
    <span class="text-xs text-gray-500 ml-2">stock: {{$item->quantity}}</span>
</div>

<script>
    function counter(max) {
        return {
          count: 0,
          increment() {
            if(this.count >= max){
                return;
            }
            this.count++;
          },
          decrement() {
            if (this.count <= 0) {
              return;
            }
            this.count--;
          }
        };
      }
</script>