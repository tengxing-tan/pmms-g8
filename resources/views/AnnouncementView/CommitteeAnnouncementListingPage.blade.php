<x-app-layout>
    <x-slot:title>Committee Announcement List</x-slot>

    <div class="p-6 w-full max-w-4xl mx-auto">
        <div class="grid grid-cols-12 items-center w-full">
            <h1 class="col-span-6 text-3xl font-semibold text-blue-800">Announcement Board</h1>
        </div>

        <div class="p-6 w-full max-w-4xl mx-auto bg-white text-gray-700 rounded-lg mt-4">
            <table class="table">
                <thead>
                    <tr class="bg-gray-100 px-4 rounded-md mt-8 font-semibold text-gray-800">
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ( $announcements as $ann )
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$ann->title}}</td>
                        <td><a href="{{url('view-announcement/'.$ann->id)}}" class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded">View</a>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
