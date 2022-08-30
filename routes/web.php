<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Billmanager;
use App\Http\Controllers\spendingmanager;
use App\Http\Controllers\profile;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Spending View

Route::get('/spending', function () {
    return view('spending');
})->middleware(['auth'])->name('spending');

require __DIR__.'/auth.php';

// Bill Manager

//Reset paid status for all items for current user
Route::get('/resetitems', [Billmanager::class, 'reset']);


//Marked Paid
Route::get('/payitems', [Billmanager::class, 'paid']);

//delete bill from db
Route::get('/delitems', [Billmanager::class, 'delete']);

//add item to db
Route::get('/additem', [Billmanager::class, 'additem']);

//End of Bill Manager

// Spend Manager

//Reset paid status for all items for current user
Route::get('/spendingresetitems', [Spendingmanager::class, 'reset']);



//delete bill from db
Route::get('/spendingdelitems', [Spendingmanager::class, 'delete']);

//add item to db
Route::get('/spendingadditem', [Spendingmanager::class, 'additem']);

//End of Spending Manager


//profile manager

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');
//Update Income
Route::get('/updatewage', [profile::class, 'updatewage']);
//Update Quartly Date
Route::get('/updateqdate', [profile::class, 'updateqdate']);