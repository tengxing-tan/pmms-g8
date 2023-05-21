<?php

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        // Redirect based on user role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin-announcement-list');
        } elseif ($user->hasRole('committee')) {
            return redirect()->route('committee-announcement-list');
        } else {
            return redirect()->route('items');
        }
    })->name('dashboard');

    // Other routes
});

Route::middleware([
    'auth:sanctum',
    'role:admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    Route::get('admin-announcement-list', [AnnouncementController::class, 'index'])->name('admin-announcement-list');
    Route::get('create-announcement', [AnnouncementController::class, 'create']);
    Route::post('save-announcement', [AnnouncementController::class, 'store']);
    Route::get('edit-announcement/{id}', [AnnouncementController::class, 'edit']);
    Route::post('update-announcement', [AnnouncementController::class, 'update']);
    Route::get('delete-announcement/{id}', [AnnouncementController::class, 'destroy']);

    Route::get('user-listing', [UserController::class, 'index'])->name('user-listing');
    Route::get('create-user', [UserController::class, 'create']);
    Route::post('save-user', [UserController::class, 'store']);
    Route::get('edit-user/{id}', [UserController::class, 'edit']);
    // Route::post('update-user', [UserController::class, 'update']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::get('delete-user/{id}', [UserController::class, 'destroy']);

    Route::resource('item', ItemController::class)
        ->missing(function (Request $request) {
            return Redirect::route('item.index'); // invoked if not be found for any of the resource's route

        });
});


Route::middleware([
    'auth:sanctum',
    'role:committee',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('committee-announcement-list', [AnnouncementController::class, 'indexCommitteeAnnouncement'])->name('committee-announcement-list');
    Route::get('view-announcement/{id}', [AnnouncementController::class, 'show']);

});

Route::middleware([
    'auth:sanctum',
    'role:cashier',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    // Route to cashier main view
    Route::get('/items', [PaymentController::class, 'index'])->name('items');
});

