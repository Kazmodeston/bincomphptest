<?php

use App\Http\Controllers\PollingUnitsController;
use App\Http\Controllers\ResultsController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('home');
}); */

Route::get("/", [PollingUnitsController::class, "index"]);
Route::get("/pulling", [PollingUnitsController::class, "getpullingUnitResults"]);
Route::get("/lga-pulling-result", [PollingUnitsController::class, "getLgaPollingResult"]);
Route::get("/get-all-lga", [PollingUnitsController::class, "getAllLga"]);
Route::get("/add-result", [ResultsController::class, "index"]);
Route::post("/add-result", [ResultsController::class, "store"]);
Route::get("/get-ward", [ResultsController::class, "getWardFromLGA"]);
