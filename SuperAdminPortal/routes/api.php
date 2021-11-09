<?php

use App\Http\Controllers\APIs\RestaurantsController;
use App\Http\Controllers\PagesController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('userImage', [PagesController::class, 'userProfileImage'])->name('userImage');
Route::get('user', [PagesController::class, 'getUser'])->name('getuser');
