<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WeeklyRoster;
use App\Models\DailyRoster;
use App\Models\Slot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Retrieve the latest weekly roster
        $weeklyRoster = WeeklyRoster::latest()->first();

        if ($weeklyRoster) {
            // Load the daily rosters and their slots with user information
            $weeklyRoster->load('dailyRosters.slot.users');
        }
        
        return view('DutyRosterView.AdminRosterPage', compact('weeklyRoster'));
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
            'endTime.*' => 'date_format:H:i|after:startTime.*',
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
            $dailyRoster->day_of_week = Carbon::parse($date)->format('l'); // Set the day_of_week based on the submitted date
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

    public function showCommitteeRoster()
    {
        // Retrieve the latest weekly roster
        $weeklyRoster = WeeklyRoster::latest()->first();

        if ($weeklyRoster) {
            // Load the daily rosters and their slots with user information
            $weeklyRoster->load('dailyRosters.slot.users');
        }

        return view('DutyRosterView.CommitteeRosterPage', compact('weeklyRoster'));
    }

    public function showCoordinatorRoster()
    {
        // Retrieve the latest weekly roster
        $weeklyRoster = WeeklyRoster::latest()->first();

        if ($weeklyRoster) {
            // Load the daily rosters and their slots with user information
            $weeklyRoster->load('dailyRosters.slot.users');
        }
        
        return view('DutyRosterView.CoordinatorRosterPage', compact('weeklyRoster'));
    }

    public function addSlot($slotId)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $slot = Slot::find($slotId);

            $userSlotsCount = $slot->users()->count(); // Count the number of users holding the slot

            if ($userSlotsCount < 2 && !$slot->users()->where('user_id', $user->id)->exists()) {
                $user->slot()->attach($slot);
                return redirect()->route('schedule')->with('success', 'Slot added to the timetable successfully');
            } 
            else {
                if($slot->users()->where('user_id', $user->id)->exists()){
                    return redirect()->route('cmtRoster')->with('error', 'You are not allowed to add the same time slot');
                }
                else{
                    return redirect()->route('cmtRoster')->with('error', 'The time slot is full');
                }
                return redirect()->route('cmtRoster')->with('error', 'Unable to add slot to the timetable');
            }
        } else {
            return redirect()->route('cmtRoster')->with('error', 'User not authenticated');
        }
    }

        public function editRoster($id)
        {
            $weeklyRoster = WeeklyRoster::findOrFail($id);

            return view('DutyRosterView.EditRosterPage', compact('weeklyRoster'));
        }

        
        public function updateRoster(Request $request, $id)
        {
            $weeklyRoster = WeeklyRoster::findOrFail($id);
        
            // Get the request data
            $requestData = $request->all();
        
            // Update the daily rosters
            $dailyRosters = [];
            $errors = [];
        
            foreach ($requestData['date'] as $index => $date) {
                $startTimeInput = $requestData['startTime'][$index];
                $endTimeInput = $requestData['endTime'][$index];
    
                // Convert input values to match database format (H:i:00)
                $startTime = date('H:i:s', strtotime($startTimeInput));
                $endTime = date('H:i:s', strtotime($endTimeInput));
    
                // Perform the validation
                if (!empty($startTime) && !preg_match('/^\d{2}:\d{2}:\d{2}$/', $startTime)) {
                    $errors[] = 'The startTime.' . $index . ' field must match the format H:i:s.';
                }
    
                if (!empty($endTime) && !preg_match('/^\d{2}:\d{2}:\d{2}$/', $endTime)) {
                    $errors[] = 'The endTime.' . $index . ' field must match the format H:i:s.';
                }
    
                if (!empty($startTime) && !empty($endTime) && $endTime <= $startTime) {
                    $errors[] = 'The endTime.' . $index . ' field must be a time after startTime.' . $index . '.';
                }
    
                // Save the daily roster data
                $dailyRosters[] = [
                    'roster_date' => $date,
                    'roster_start_time' => $startTime,
                    'roster_end_time' => $endTime,
                ];
            }
            
        
            if (!empty($errors)) {
                // Redirect back with validation errors
                return redirect()->back()->withErrors($errors);
            }
        
            // Find the IDs of the daily rosters to delete slots
            $rosterIdsToDelete = $weeklyRoster->dailyRosters->pluck('id')->toArray();
        
            // Retrieve the IDs of the slots associated with the daily rosters to be deleted
            $slotIdsToDelete = Slot::whereIn('daily_roster_id', $rosterIdsToDelete)->pluck('id')->toArray();
        
            // Retrieve the IDs of the slot_user records associated with the slots
            $slotUserIdsToDelete = DB::table('slot_user')->whereIn('slot_id', $slotIdsToDelete)->pluck('slot_id')->toArray();
        
            // Delete the slot_user records
            DB::table('slot_user')->whereIn('slot_id', $slotUserIdsToDelete)->delete();
        
            // Delete the slots
            Slot::whereIn('id', $slotIdsToDelete)->delete();
        
            // Delete existing daily rosters
            $weeklyRoster->dailyRosters()->delete();
        
            // Create and save the updated daily rosters
            foreach ($dailyRosters as $dailyRosterData) {
                $dailyRoster = new DailyRoster($dailyRosterData);
                $dailyRoster->day_of_week = Carbon::parse($dailyRosterData['roster_date'])->format('l');
                $weeklyRoster->dailyRosters()->save($dailyRoster);
    
                // Generate and save slots for the current daily roster
                $this->generateTimeSlots($dailyRoster, $dailyRosterData['roster_start_time'], $dailyRosterData['roster_end_time']);
            }
        
            return redirect()->route('AdminRoster')->with('success', 'Weekly roster updated successfully.');
        }
        



    public function deleteRoster($id)
    {
        $roster = WeeklyRoster::findOrFail($id);

        // Delete the related slots
        $roster->dailyRosters()->each(function ($dailyRoster) {
            $dailyRoster->slot()->delete();
        });

        // Delete the related daily rosters
        $roster->dailyRosters()->delete();

        // Delete the selected weekly roster
        $roster->delete();

        return redirect()->route('AdminRoster')->with('success', 'Weekly roster deleted successfully.');
    }

    public function showSchedule()
    {
        $user = auth()->user();
        
        // Retrieve the weekly rosters that have slots assigned to the authenticated user
        $userSchedule = WeeklyRoster::whereHas('dailyRosters.slot.users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();
        
        return view('DutyRosterView.SchedulePage', ['userSchedule' => $userSchedule]);
    }

    public function deleteTimeSlot($slotId)
{
    // Find the slot by its ID
    $slot = Slot::findOrFail($slotId);
    
    // Detach the authenticated user from the slot
    $slot->users()->detach(auth()->user()->id);
    
    // Redirect back or return a response indicating success
    return back()->with('success', 'Time slot deleted successfully');
}


}