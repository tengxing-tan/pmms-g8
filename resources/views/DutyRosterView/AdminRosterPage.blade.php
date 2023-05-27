<!DOCTYPE html>
<html>
<head>
    <title>All Duty Rosters</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center">ALL DUTY ROSTERS</h1>
        <p class="text-green-500">{{ session('success') }}</p>
        </br>
        <form action="{{ route('NewRoster') }}" method="GET">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                + NEW
            </button>
        </form>

        @if($weeklyRosters->count() > 0)
            @foreach($weeklyRosters as $weeklyRoster)
                @php
                    $firstDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->min('roster_date'))->format('j F Y');
                    $lastDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->max('roster_date'))->format('j F Y');
                @endphp

                <h1 class="text-2xl font-bold mt-8">Weekly Duty Roster ({{ $firstDate }} - {{ $lastDate }})</h1>
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
                <div class="flex justify-end mt-4">
                    <a href="{{ route('editRoster', $weeklyRoster->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded">Edit</a>
                    <div class="ml-4"></div>
                    <!-- Delete Button -->
                    <form action="{{ route('deleteRoster', $weeklyRoster->id) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded" onclick="return confirm('Are you sure you want to delete this weekly roster?')">Delete</button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="mt-4">No weekly rosters available.</p>
        @endif
    </div>
</body>
</html>
