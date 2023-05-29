<x-app-layout>
    <!DOCTYPE html>
        <html>
        <head>
            <title>All Duty Rosters</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <!-- Include Tailwind CSS -->
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="bg-gray-100">
            <div class="container mx-auto p-6 max-w-6xl" x-data="{ openDelConfirm: null }">
                <h1 class="col-span-6 text-3xl font-semibold text-gray-800 pb-6">All Duty Roster</h1>
                <div class="p-6 w-full max-w-6xl mx-auto bg-white text-gray-700 rounded-lg">
                    <p class="text-green-500">{{ session('success') }}</p>
                    <form action="{{ route('NewRoster') }}" method="GET">
                        @csrf
                        <button type="submit" class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded">
                            + NEW
                        </button>
                    </form>

                    @if($weeklyRosters->count() > 0)
                        @foreach($weeklyRosters as $weeklyRoster)
                            @php
                                $firstDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->min('roster_date'))->format('j F Y');
                                $lastDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->max('roster_date'))->format('j F Y');
                            @endphp

                            <h1 class="col-span-6 text-2xl font-semibold text-gray-800 mt-4">Weekly Duty Roster ({{ $firstDate }} - {{ $lastDate }})</h1>
                            <table class="mt-4 w-full">
                                <thead>
                                    <tr>
                                        <th class="bg-gray-200 text-center py-2 px-4">Date</th>
                                        <th class="bg-gray-200 text-center py-2 px-4">Day of Week</th>
                                        <th class="bg-gray-200 text-center py-2 px-4">Slot Time</th>
                                        <th class="bg-gray-200 text-center py-2 px-4">Person-In-Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $previousDayOfWeek = null;
                                    @endphp
                                    @foreach($weeklyRoster->dailyRosters as $dailyRoster)
                                        @php
                                            $date = \Carbon\Carbon::parse($dailyRoster->roster_date)->format('j F Y');
                                        @endphp
                                        @foreach($dailyRoster->slot as $index => $slot)
                                            @php
                                                $startTime = \Carbon\Carbon::parse($slot->start_slot);
                                                $endTime = \Carbon\Carbon::parse($slot->end_slot);
                                            @endphp
                                            <tr>
                                                @if($index === 0)
                                                    @if($dailyRoster->day_of_week === $previousDayOfWeek)
                                                        <td class="border border-gray-300 text-center"></td>
                                                    @else
                                                        <td class="border border-gray-300 text-center py-2 px-4" rowspan="{{ count($dailyRoster->slot) }}">{{ $date }}</td>
                                                        <td class="border border-gray-300 py-2 px-4 text-center" rowspan="{{ count($dailyRoster->slot) }}">{{ $dailyRoster->day_of_week }}</td>
                                                    @endif
                                                @endif
                                                <td class="border border-gray-300 text-center py-2 px-4">
                                                    <div>{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</div>
                                                </td>
                                                <td class="border border-gray-300 text-center py-2 px-4">
                                                    @foreach($slot->users as $user)
                                                        <div>{{ $user->name }}</div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @php
                                                $previousDayOfWeek = $dailyRoster->day_of_week;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            </br>
                            <div class="flex justify-end">
                                <a href="{{ route('editRoster', $weeklyRoster->id) }}" class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded mb-4">Edit</a>
                                <div class="ml-4"></div>
                                <div>
                                {{-- <a href="{{url('deleteRoster/'.$weeklyRoster->id)}}" class="btn btn-danger">Delete</a> --}}
                                <div>
                                <button class="col-span-6 justify-self-end block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor ml-2" type="button" x-on:click="openDelConfirm = {{ $weeklyRoster->id }}">Delete</button>
    
                                <template x-if="openDelConfirm === {{ $weeklyRoster->id }}">
                                    <form action="{{ url('roster/'.$weeklyRoster->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="absolute top-0 bottom-0 left-0 right-0 flex justify-center items-center">
                                            <div class="bg-white rounded shadow-2xl shadow-gray-500/50 p-12 px-24 flex flex-col items-center">
                                                <p class="text-xl font-bold text-gray-800 mb-6">Confirm to delete?</p>
                                                <div class="flex">
                                                    <input type="submit" value="Delete" class="block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor" />
                                                    <button class="ml-4 py-2 px-4 rounded bg-gray-500 hover:bg-gray-700 font-medium text-white cursor" type="button" x-on:click="openDelConfirm = false">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </template>
                            </div>
                        @endforeach
                    @else
                    <p class="mt-4">No weekly rosters available.</p>
                    @endif
                </div>
            </div>
        </body>
    </html>
</x-app-layout>
