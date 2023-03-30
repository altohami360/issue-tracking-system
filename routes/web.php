<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketStatusController;
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

Route::middleware('auth')->group(function () {

    Route::redirect('/dashboard', 'tickets')->name('dashboard');

    Route::redirect('/', 'tickets');

    Route::controller(TicketStatusController::class)->prefix('tickets')->group(function () {

        Route::patch('{ticket}/solve', 'solve')->name('tickets.solve');

        Route::patch('{ticket}/close', 'close')->name('tickets.close');

        Route::patch('{ticket}/reopen', 'reopen')->name('tickets.reopen');

        Route::patch('{ticket}/archive', 'archive')->name('tickets.archive');

        Route::patch('{ticket}/unarchived', 'unarchived')->name('tickets.unarchived');
    });

    Route::middleware('can:admin')->group(function () {

        Route::resource('users', UserController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('labels', LabelController::class);
    });

    Route::resource('tickets', TicketController::class);

    Route::post('messages/send', [MessageController::class, 'send'])->name('messages.send');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
