<x-app-layout>
<!DOCTYPE html>
<html>
<head>
    <title>Committee Duty Roster Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6 max-w-6xl">
        <h1 class="col-span-6 text-3xl font-semibold text-blue-800 pb-6">Latest Duty Roster</h1>
        <div class="p-6 w-full max-w-6xl mx-auto bg-white text-gray-700 rounded-lg">
        <p class="text-green-500">{{ session('success') }}</p>

        @if(isset($weeklyRoster))
            @php
            $firstDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->min('roster_date'))->format('j F Y');
            $lastDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->max('roster_date'))->format('j F Y');
        @endphp

    <h1 class="col-span-6 text-2xl font-semibold text-blue-800">Weekly Duty Roster ({{ $firstDate }} - {{ $lastDate }})</h1>
            <table class="mt-4 w-full">
                <thead>
                    <tr>
                        <th class="bg-gray-100 text-center py-2 px-4">Date</th>
                        <th class="bg-gray-100 text-center py-2 px-4">Day of Week</th>
                        <th class="bg-gray-100 text-center py-2 px-4">Slot Time</th>
                        <th class="bg-gray-100 text-center py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $previousDate = null;
                        $previousDay = null;
                    @endphp
                    @foreach($weeklyRoster->dailyRosters as $dailyRoster)
                    
                        @foreach($dailyRoster->slot as $index => $slot)
                            @php
                                $startDate = \Carbon\Carbon::parse($dailyRoster->roster_date);
                                $startTime = \Carbon\Carbon::parse($slot->start_slot);
                                $endTime = \Carbon\Carbon::parse($slot->end_slot);
                            @endphp
                            <tr>
                                @if($previousDate != $startDate)
                                    <td class="border text-center py-2 px-4" rowspan="{{ count($dailyRoster->slot) }}">{{ $startDate->format('j F Y') }}</td></td>
                                    @php
                                        $previousDate = $startDate;
                                    @endphp
                                @endif
                                @if($previousDay != $dailyRoster->day_of_week)
                                    <td class="border text-center py-2 px-4" rowspan="{{ count($dailyRoster->slot) }}">{{ $dailyRoster->day_of_week }}</td>
                                    @php
                                        $previousDay = $dailyRoster->day_of_week;
                                    @endphp
                                @endif
                                <td class="border text-center py-2 px-4">
                                    <div>{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</div>
                                </td>
                                <td class="border text-center py-2 px-4">
                                    <!-- @foreach($slot->users as $user)
                                        <div>{{ $user->name }}</div>
                                    @endforeach -->
                                    <form action="{{ route('addSlot', $slot->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded">
                                            Add Slot
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4">No weekly roster available.</p>
        @endif
    </div>
</div>
<script>
    // Check if there is an error message in the session flash data
    var errorMessage = '{{ session("error") }}';
    if (errorMessage) {
        // Display the error message in a popup or an alert box
        alert(errorMessage);
    }
</script>
</body>
</html>
</x-app-layout>