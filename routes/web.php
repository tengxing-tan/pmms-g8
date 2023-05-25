<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
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
            return redirect()->route('item.index');
        } elseif ($user->hasRole('cashier')) {
            return redirect()->route('items');
        } elseif ($user->hasRole('committee')) {
            return redirect()->route('announcement-list');
        } else{
            return redirect()->route('report');
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
    Route::delete('delete-announcement/{id}', [AnnouncementController::class, 'destroy']);

    Route::get('user-listing', [UserController::class, 'index'])->name('user-listing');
    Route::get('create-user', [UserController::class, 'create']);
    Route::post('save-user', [UserController::class, 'store']);
    Route::get('edit-user/{id}', [UserController::class, 'edit']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::delete('delete-user/{id}', [UserController::class, 'destroy']);


});


Route::middleware([
    'auth:sanctum',
    'role:cashier',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Route to cashier main view
    Route::get('/items', [PaymentController::class, 'items'])->name('items');

    //Route to payment view
    Route::post('/payment', [PaymentController::class, 'payment']);

    //Route to receipt view
    Route::post('/receipt', [PaymentController::class, 'receipt']);
});

Route::middleware([
    'auth:sanctum',
    'role:coordinator',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/report', [ReportController::class, 'report'])->name('report');

});

Route::middleware([
    'auth:sanctum',
    'role:committee|coordinator', // Allow both committee and coordinator roles
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('announcement-list', [AnnouncementController::class, 'indexCommitteeAnnouncement'])->name('announcement-list');
    Route::get('view-announcement/{id}', [AnnouncementController::class, 'show']);
});

Route::middleware([
    'auth:sanctum',
    'role:admin|cashier', // Allow both admin and cashier roles
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/item/filter', [ItemController::class, 'filter'])->name('item.filter');
    Route::resource('item', ItemController::class)
        ->missing(function (Request $request) {
            dd($request);
            return Redirect::route('item.index'); // invoked if not be found for any of the resource's route

        });

});






