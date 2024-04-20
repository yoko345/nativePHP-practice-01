<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

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
    return to_route("memo.index");
});
Route::prefix("memo")->controller(MemoController::class)->group(function () {
    Route::get('/', [MemoController::class, "index"])->name("memo.index");
    Route::get('/list', [MemoController::class, "list"])->name("memo.list");
    Route::post('/save', [MemoController::class, "save"])->name("memo.save");
    Route::delete('/delete/{memo}', [MemoController::class, "destroy"])->name("memo.destroy");
});
