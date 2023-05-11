<?php

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('inventory', InventoryController::class)
    ->missing(function (Request $request) {
        return Redirect::route('inventory.index'); // invoked if not be found for any of the resource's route
    }); 

// Route to cashier main view
Route::get('/items', [PaymentController::class, 'index'])->name('items');

//Route to payment view
Route::post('/payment', [PaymentController::class, 'payment']);

//Route to receipt view
Route::post('/receipt', [PaymentController::class, 'receipt']);
