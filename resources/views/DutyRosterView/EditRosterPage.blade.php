<head>
    <title>Edit Weekly Roster</title>
    <!-- Add necessary CSS and JavaScript libraries -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include the Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .input-label {
            font-weight: 600;
        }

        .input-field {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #E2E8F0;
        }

        .input-field:focus {
            outline: none;
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        .error-message {
            color: #EF4444;
            font-size: 0.875rem;
        }

        .submit-button {
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            background-color: #2563EB;
            color: #FFFFFF;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #1D4ED8;
        }
    </style>
</head>

<body class="bg-gray-100">
    <h1 class="text-3xl font-bold text-center">Edit Weekly Roster</h1>

    <div class="flex justify-center items-center min-h-screen">
        

        <form action="{{ route('updateRoster', $weeklyRoster->id) }}" method="POST" class="w-2/3 bg-white shadow-md rounded p-8">
            @csrf
            @method('PUT')
            <div id="daily-rosters-container">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="input-label">Date</th>
                            <th class="input-label">Start Time</th>
                            <th class="input-label">End Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weeklyRoster->dailyRosters as $dailyRoster)
                            <tr class="daily-roster">
                                <td>
                                    <div class="form-group">
                                        <input type="date" name="date[]" class="input-field w-full" value="{{ $dailyRoster->roster_date }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="time" name="startTime[]" class="input-field w-full" value="{{ $dailyRoster->roster_start_time }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="time" name="endTime[]" class="input-field w-full" value="{{ $dailyRoster->roster_end_time }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="delete-roster-button" onclick="deleteRoster(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-500 rounded p-4 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <hr class="my-6">
            <button type="button" id="add-roster-button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded">Add Daily Roster</button></br></br></br></br>
            <button type="submit" id="submit-button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded">Update Weekly Roster</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
        var maxRosters = 7; // Maximum number of daily rosters allowed

        // Add new daily roster
        $('#add-roster-button').click(function () {
            var rostersCount = $('.daily-roster').length;

            if (rostersCount < maxRosters) {
                var newRosterHtml = `
                    <tr class="daily-roster">
                        <td>
                            <div class="form-group">
                                <input type="date" name="date[]" required class="input-field w-full">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="time" name="startTime[]" value="{{ old('startTime', '09:00') }}" required class="input-field w-full">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="time" name="endTime[]" value="{{ old('endTime', '17:00') }}" required class="input-field w-full">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <button type="button" class="delete-roster-button" onclick="deleteRoster(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;

                $('#daily-rosters-container tbody').append(newRosterHtml);
            }
        });

        // Delete daily roster
        $(document).on('click', '.delete-roster-button', function () {
            $(this).closest('.daily-roster').remove();
        });

        // Function to delete roster
        function deleteRoster(button) {
            $(button).closest('.daily-roster').remove();
        }
    });
</script>
</body>
