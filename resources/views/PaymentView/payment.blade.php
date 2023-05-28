<x-app-layout>
    <form action="/receipt" method="POST">
        @csrf
        <div class="my-6 drop-shadow-md mx-16 bg-white rounded-lg h-auto py-4 px-8 justify-center">
            <div class="grid grid-cols-3 gap-4 my-4 mx-12">
                <span class="font-bold text-md">Item</span>
                <span class="font-bold text-md text-center">Quantity</span>
                <span class="font-bold text-md text-end">Price</span>
            </div>
            @foreach($items as $item)
                <x-item-list :item="$item"/>
            @endforeach 
            <hr/>
            <div class="flex justify-between my-4 mx-8">
                <span class="font-black text-lg">Total</span>
                <span class="font-black text-lg text-orange-400"><span>RM </span class="font-black">{{$total_price}}</span>
                <input type="number" name="total_price" value="{{$total_price}}" class="text-lg font-black text-orange-400 hidden"/>
            </div>
            <div class="flex justify-between my-4 mx-8">
                <label for="paid_amount" class="font-black text-lg">Payment Amount (RM)</label>
                <input type="decimal" name="paid_amount" placeholder="Enter Payment Amount" class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" required/>

                @error('paid_amount')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="flex justify-end space-x-6 mx-6 mt-8">
                <a href="/items" class="rounded-lg border-2 border-orange-300 bg-transparent hover:bg-gray-100 active:bg-gray-200"><x-secondary-button>Cancel</x-secondary-button></a>
                <x-button>Pay</x-button>
            </div>
        </div>
    </form>
</x-app-layout>