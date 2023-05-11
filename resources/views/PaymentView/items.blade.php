<x-app-layout>
    <div class="mx-12 my-4">
        <form action="/items">          
            <div class="relative m-2 items-center drop-shadow-sm">
                <div class="absolute top-4 left-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>                      
                </div>
                <input type="text" name="search" class="h-14 pl-12 pr-20 rounded-lg z-0 border-none focus:ring-orange-500" placeholder="Search"/>
            </div>
        </form>

        <form action="/payment" method="POST">
            @csrf
            <div class="mx-4 mt-8 grid lg:grid-cols-5 gap-12 md:grid-cols-3">
            
                @unless(count($items) == 0)

                @foreach($items as $item)
                    <x-item-card :item="$item"/>
                @endforeach

                @else
                    <p>No listings found</p>
                @endunless
            </div> 
            <div class="flex justify-end mr-6 mt-6">
                <x-button class="flex pt-2 align-self-end">NEXT</x-button>
            </div>
        </form>
    </div>
</x-app-layout>