<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WeeklyRoster;
use App\Models\DailyRoster;
use App\Models\Slot;

class DutyRosterController extends Controller
{
    public function index()
    {
        // Retrieve all the existing weekly rosters
        $rosters = WeeklyRoster::all();

        return view('weekly-roster.index', compact('rosters'));
    }

    public function showAdminRoster()
    {
        return view('DutyRosterView.AdminRosterPage');
    }

    public function newRoster()
    {
        return view('DutyRosterView.NewRosterPage');
    }

    public function createRoster(Request $request)
    {
        // Validate the form input
        // $validatedData = $request->validate([
        //     'date' => 'required|date',
        //     'startTime' => 'required|time',
        //     'endTime' => 'required|time',
        // ]);
        $request->validate([
            'date' => 'required|array',
            'date.*' => 'date',
            'startTime' => 'required|array',
            'startTime.*' => 'date_format:H:i',
            'endTime' => 'required|array',
            'endTime.*' => 'date_format:H:i',
        ]);

        $weeklyRoster = new WeeklyRoster();
        // $weeklyRoster->date = $request->input('date');
        // $weeklyRoster->startTime = $request->input('startTime');
        // $weeklyRoster->endTime = $request->input('endTime');
        $weeklyRoster->save();

    // // Save the roster to the database
        

    // error_log(request('date'));
    // error_log(request('start'));
    // error_log(request('end'));

        $dates = $request->input('date');
        $startTimes = $request->input('startTime');
        $endTimes = $request->input('endTime');

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        // dd($dates);
        // dd($startTimes);
        // dd($endTimes);
        // foreach ($dates as $key => $date) {
        //     $dailyRoster = new DailyRoster();
        //     $dailyRoster->roster_date = $dates;
        //     $dailyRoster->roster_start_time = $startTimes[$key];
        //     $dailyRoster->roster_end_time = $endTimes[$key];
        //     $weeklyRoster->dailyRosters()->save($dailyRoster);
        // }
        
        foreach ($dates as $key => $date) {
            $dailyRoster = new DailyRoster();
            $dailyRoster->roster_date = $date;
            $dailyRoster->roster_start_time = $startTimes[$key];
            $dailyRoster->roster_end_time = $endTimes[$key];
            $weeklyRoster->dailyRosters()->save($dailyRoster);

            // Generate and save slots for the current daily roster
            $this->generateTimeSlots($dailyRoster, $startTimes[$key], $endTimes[$key]);
        }
        return redirect()->route('Saved')->with('success', 'Weekly roster created successfully.');
    }

    

    private function generateTimeSlots(DailyRoster $dailyRoster, $startTime, $endTime)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);
        $interval = 120; // 2 hours in minutes

        while ($startTime < $endTime) {
            $slotEndTime = $startTime->copy()->addMinutes($interval);
            
            // Check if the slot end time exceeds the overall end time
            if ($slotEndTime > $endTime) {
                $slotEndTime = $endTime; // Set the slot end time to the overall end time
            }
    
            $slot = new Slot();
            $slot->start_slot = $startTime->format('H:i');
            $slot->end_slot = $slotEndTime->format('H:i');
            $slot->daily_roster_id = $dailyRoster->id; // Associate the slot with the daily roster
            $slot->save();
    
            $startTime->addMinutes($interval); // Move to the next slot start time
        }
    }


    public function edit($id)
    {
        // Retrieve the weekly roster entry to be edited
        $roster = WeeklyRoster::findOrFail($id);

        return view('weekly-roster.edit', compact('roster'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'opening_time' => 'required',
            'closing_time' => 'required|after:opening_time',
        ]);

        // Find the weekly roster entry to be updated
        $roster = WeeklyRoster::findOrFail($id);
        
        // Update the roster details
        $roster->date = $validatedData['date'];
        $roster->opening_time = $validatedData['opening_time'];
        $roster->closing_time = $validatedData['closing_time'];
        // Update any other necessary fields
        
        // Save the changes
        $roster->save();

        return redirect()->route('weekly-roster.index')->with('success', 'Weekly roster updated successfully!');
    }
}