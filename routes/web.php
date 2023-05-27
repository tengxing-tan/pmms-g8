<?php

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DutyRosterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin-announcement-list', [AnnouncementController::class, 'index'])->name('admin-announcement-list');
Route::get('create-announcement', [AnnouncementController::class, 'create']);
Route::post('save-announcement', [AnnouncementController::class, 'store']);
Route::get('edit-announcement/{id}', [AnnouncementController::class, 'edit']);
Route::post('update-announcement', [AnnouncementController::class, 'update']);
Route::get('delete-announcement/{id}', [AnnouncementController::class, 'destroy']);
Route::get('committee-announcement-list', [AnnouncementController::class, 'indexCommitteeAnnouncement']);
Route::get('view-announcement/{id}', [AnnouncementController::class, 'show']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('item', ItemController::class)
        ->missing(function (Request $request) {
            return Redirect::route('item.index'); // invoked if not be found for any of the resource's route
        });
});

// Route to cashier main view
Route::get('/items', [PaymentController::class, 'index'])->name('items');


Route::get('/adminRoster', 'App\Http\Controllers\DutyRosterController@showAdminRoster')->name('AdminRoster');
Route::post('/adminRoster', 'App\Http\Controllers\DutyRosterController@createRoster')->name('Saved');
Route::get('/newRoster', 'App\Http\Controllers\DutyRosterController@newRoster')->name('NewRoster');
Route::get('/cmtRoster', 'App\Http\Controllers\DutyRosterController@showCommitteeRoster')->name('cmtRoster');
Route::post('/add-slot/{slotId}', 'App\Http\Controllers\DutyRosterController@addSlot')->name('addSlot');
Route::get('/editRoster/{id}', 'App\Http\Controllers\DutyRosterController@editRoster')->name('editRoster');
Route::put('/roster/{id}', 'App\Http\Controllers\DutyRosterController@updateRoster')->name('updateRoster');
Route::delete('/roster/{id}', 'App\Http\Controllers\DutyRosterController@deleteRoster')->name('deleteRoster');
Route::get('/schedule', 'App\Http\Controllers\DutyRosterController@showSchedule')->name('schedule');
Route::delete('/slots/{slotId}', 'App\Http\Controllers\DutyRosterController@deleteTimeSlot')->name('deleteTimeSlot');
