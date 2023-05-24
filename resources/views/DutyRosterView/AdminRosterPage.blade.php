<!DOCTYPE html>
<html>
<head>
    <title>Latest Duty Roster</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Latest Duty Roster!</h1>
        <p class="text-green-500">{{ session('success') }}</p>
        <form action="{{ route('NewRoster') }}" method="GET">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                New
            </button>
        </form>

        @if(isset($weeklyRoster))
            <h1 class="text-2xl font-bold mt-8">Weekly Roster</h1>
            <table class="mt-4 w-full">
                <thead>
                    <tr>
                        <th class="bg-gray-200 text-left py-2 px-4">Day of Week</th>
                        <th class="bg-gray-200 text-left py-2 px-4">Slot Time</th>
                        <th class="bg-gray-200 text-left py-2 px-4">User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weeklyRoster->dailyRosters as $dailyRoster)
                        <tr>
                            <td class="border py-2 px-4">{{ $dailyRoster->day_of_week }}</td>
                            <td class="border py-2 px-4">
                                @foreach($dailyRoster->slot as $slot)
                                @php
                                    $startTime = \Carbon\Carbon::parse($slot->start_slot);
                                    $endTime = \Carbon\Carbon::parse($slot->end_slot);
                                @endphp
                                <div>{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</div>
                                @endforeach
                            </td>
                            <td class="border py-2 px-4">
                                @foreach($dailyRoster->slot as $slot)
                                    @foreach($slot->users as $user)
                                        <div>{{ $user->name }}</div>
                                    @endforeach
                                @endforeach
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4">No weekly roster available.</p>
        @endif
    </div>
</body>
</html>

