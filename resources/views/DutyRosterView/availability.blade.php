<!-- resources/views/availability.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Your Availability</h2>
    <form action="{{ route('update-availability') }}" method="POST">
        @csrf
        <div id="availability-container">
            <div class="availability-entry">
                <input type="date" name="available_dates[0][date]" required>
                <input type="time" name="available_dates[0][start_time]" required>
                <input type="time" name="available_dates[0][end_time]" required>
                <button type="button" onclick="addAvailabilityEntry()">Add More</button>
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    let availabilityIndex = 1;

    function addAvailabilityEntry() {
        let container = document.getElementById('availability-container');
        let newEntry = document.createElement('div');
        newEntry.className = 'availability-entry';
        newEntry.innerHTML = `
            <input type="date" name="available_dates[${availabilityIndex}][date]" required>
            <input type="time" name="available_dates[${availabilityIndex}][start_time]" required>
            <input type="time" name="available_dates[${availabilityIndex}][end_time]" required>
            <button type="button" onclick="removeAvailabilityEntry(this)">Remove</button>
        `;
        container.appendChild(newEntry);
        availabilityIndex++;
    }

    function removeAvailabilityEntry(button) {
        button.parentElement.remove();
    }
</script>
@endsection
