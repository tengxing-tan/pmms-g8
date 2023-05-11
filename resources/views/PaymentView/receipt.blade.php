<x-app-layout>
    <div class="mx-60 my-8 drop-shadow-md bg-white items-center justify-center rounded-lg pt-12 pb-4">
        <p class="font-black text-xl text-center">PAYMENT SUCCESSFUL</p>
        <div class="flex justify-center my-8">
            <div class="relative bg-green-400 rounded-full w-16 h-16">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="#f3f3f3" class="w-8 h-8 bg-green-400 rounded-full m-4 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>      
            </div> 
        </div>
        <p class="font-bold text-center"># {{$payment->payment_id}}</p>
        <p class="font-bold text-center">{{$payment->created_at}}</p>

        <div class="grid grid-cols-3 gap-4 mt-12 mb-4 mx-12">
            <span class="font-bold text-md">Item</span>
            <span class="font-bold text-md text-center">Quantity</span>
            <span class="font-bold text-md text-end">Price</span>
        </div>
        @foreach($items as $item)
            <x-item-list :item="$item"/>
        @endforeach

        <hr class="mx-12" />

        <div class="flex justify-between my-4 mx-12">
            <span class="font-black text-lg">Total</span>
            <span class="font-black text-lg text-orange-400"><span>RM </span class="font-black">{{$total_price}}</span>
        </div>
        <div class="flex justify-between my-4 mx-12">
            <span class="font-black text-lg">Paid (RM)</span>
            <span class="font-black text-lg">RM {{$payment_amount}}</span>
        </div>
        <div class="flex justify-between my-4 mx-12">
            <span class="font-black text-lg">Change</span>
            <span class="font-black text-lg">RM {{$change}}</span>
        </div>
    </div>
    <div class="flex justify-center items-center mb-4">
        <a href="/items">
            <x-button class="flex pt-2 align-self-end">HOME</x-button>
        </a>
    </div>
</x-app-layout>