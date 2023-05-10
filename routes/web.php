<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;

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

Route::get('admin-announcement-list',[AnnouncementController::class,'index']);
Route::get('create-announcement',[AnnouncementController::class,'create']);
Route::post('save-announcement',[AnnouncementController::class,'store']);
Route::get('edit-announcement/{id}',[AnnouncementController::class,'edit']);
Route::post('update-announcement',[AnnouncementController::class,'update']);
Route::get('delete-announcement/{id}',[AnnouncementController::class,'destroy']);
Route::get('committee-announcement-list',[AnnouncementController::class,'indexCommitteeAnnouncement']);
Route::get('view-announcement/{id}',[AnnouncementController::class,'show']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
