<!DOCTYPE html>
<html>
<head>
    <title>Schedule Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 16px; /* Increase the margin-top value for more spacing */
            margin-bottom: 32px;
        }
        
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">My Schedule</h1>
        <p class="text-green-500">{{ session('success') }}</p>

        @if($userSchedule->isNotEmpty())
            @foreach($userSchedule as $weeklyRoster)
                @php
                    $firstDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->min('roster_date'))->format('j F Y');
                    $lastDate = \Carbon\Carbon::parse($weeklyRoster->dailyRosters->max('roster_date'))->format('j F Y');
                @endphp

                <h1 class="text-2xl font-bold mt-8">Weekly Duty Roster ({{ $firstDate }} - {{ $lastDate }})</h1>

                <div class="table-container">
                    <table class="mt-4 w-full">
                        <thead>
                            <tr>
                                <th class="bg-gray-200 text-left py-2 px-4">Date</th>
                                <th class="bg-gray-200 text-left py-2 px-4">Day of Week</th>
                                <th class="bg-gray-200 text-left py-2 px-4">Slot Time</th>
                                <th class="bg-gray-200 text-left py-2 px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($weeklyRoster->dailyRosters as $dailyRoster)
                                @foreach($dailyRoster->slot as $index => $slot)
                                    @php
                                        $startDate = \Carbon\Carbon::parse($dailyRoster->roster_date);
                                        $startTime = \Carbon\Carbon::parse($slot->start_slot);
                                        $endTime = \Carbon\Carbon::parse($slot->end_slot);
                                        $userSlotIds = $slot->users->pluck('id')->toArray();
                                    @endphp
                                    @if(in_array(auth()->user()->id, $userSlotIds))
                                        <tr>
                                            <td class="border py-2 px-4">{{ $startDate->format('j F Y') }}</td>
                                            <td class="border py-2 px-4">{{ $dailyRoster->day_of_week }}</td>
                                            <td class="border py-2 px-4">
                                                <div>{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</div>
                                            </td>
                                            <td class="border py-2 px-4">
                                                <!-- @foreach($slot->users as $user)
                                                    <div>{{ $user->name }}</div>
                                                @endforeach -->
                                                <form id="deleteForm{{ $slot->id }}" action="{{ route('deleteTimeSlot', $slot->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded"
                                                        onclick="showConfirmation('{{ $slot->id }}')">
                                                        DROP
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            <form action="{{ route('cmtRoster') }}" method="GET">
                @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded">
                    Add More Time Slot
                </button>
            </form>
        @else
            <p class="mt-4">No timetable available.</p>
        @endif
    </div>

    <script>
        function showConfirmation(slotId) {
            if (confirm('Are you sure you want to drop this slot?')) {
                // Submit the delete form
                document.getElementById('deleteForm' + slotId).submit();
            }
        }

        // Check if there is an error message in the session flash data
        var errorMessage = '{{ session("error") }}';
        if (errorMessage) {
            // Display the error message in a popup or an alert box
            alert(errorMessage);
        }

    </script>
</body>
</html>
