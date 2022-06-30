<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

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

Route::get('/', [ReportController::class, 'index']);
Route::get('/reports/create', [ReportController::class, 'create'])->middleware('auth');
Route::get('/reports/{id}', [ReportController::class, 'show']);
Route::post('/reports', [ReportController::class, 'store']);
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->middleware('auth');
Route::get('/reports/edit/{id}', [ReportController::class, 'edit'])->middleware('auth');
Route::put('/reports/update/{id}', [ReportController::class, 'update'])->middleware('auth');

//new - specify game
Route::get('/reports/main/{game}', [ReportController::class, 'main']);

// new - comment
Route::post('/reports/makecomment/{id}', [ReportController::class, 'makeCommentReport'])->middleware('auth');
// new - delete comment
Route::delete('/reports/deletecomment/{id}', [ReportController::class, 'deleteCommentReport'])->middleware('auth');

// new - new editor
Route::put('/reports/makeeditor', [ReportController::class, 'makeEditor'])->middleware('auth');

Route::get('/dashboard', [ReportController::class, 'dashboard'])->middleware('auth');



/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
*/