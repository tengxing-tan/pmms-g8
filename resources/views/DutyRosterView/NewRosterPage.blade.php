<head>
    <title>NewWeeklyRoster</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .roster {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Create Weekly Roster</h1>
<div class="roster">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/adminRoster">
    @csrf
    <div id="daily-rosters-container">
        <table class="table-roster">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="daily-roster">
                    <td>
                        <div class="form-group">
                            <input type="date" name="date[]" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="time" name="startTime[]" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="time" name="endTime[]" required>
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
            </tbody>
        </table>
    </div>
    <hr>
    <button type="button" id="add-roster-button">Add Daily Roster</button>
    <button type="submit" class="btn btn-primary">Create Weekly Roster</button>
</form>

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
                                <input type="date" name="date[]" required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="time" name="startTime[]" required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="time" name="endTime[]" required>
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
</div>
</body>
