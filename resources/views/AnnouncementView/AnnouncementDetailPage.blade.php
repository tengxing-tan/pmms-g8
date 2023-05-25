<x-app-layout>
    <x-slot:title>Announcement Details</x-slot>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg">
                        <h2 class="col-span-6 text-3xl font-semibold text-gray-800 mb-4">Announcement Detail</h2>

                        <label for="ann_title" class="col-span-3 flex flex-col">
                            <span class="font-medium text-gray-700 mb-1">Title: </span>
                            <input name="ann_title" value="{{$announcements->title}}" id="ann_title" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" disabled />
                        </label>
                        <br>
                        <label for="ann_desc" class="col-span-3 flex flex-col">
                            <span class="font-medium text-gray-700 mb-1">Description: </span>
                            <input name="ann_desc" value="{{$announcements->description}}" id="ann_desc" class="border-none bg-gray-100 rounded focus:ring-2 focus:ring-amber-500" type="text" disabled />
                        </label>

                        <br>

                        <div class="flex">
                            <button class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded"><a href="{{url('announcement-list')}}" >Back</a></button>
                        </div>

                    </div>
            </div>
        </div>
</x-app-layout>
