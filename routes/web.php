<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadioLogController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\DashboardController;



use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/guest',[GuestController::class, 'index'])->name('guest.index');
Route::get('/guest/create',[GuestController::class, 'create'])->name('guest.create');
Route::post('/guest',[GuestController::class, 'store'])->name('guest.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile routes (for authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //OCD MIMAROPA Radio logs
    Route::get('/radiolog', [RadioLogController::class, 'index'])->name('radiolog.index');
    Route::get('/radiolog/create', [RadioLogController::class,'create'])->name('radiolog.create');
    Route::post('/radiolog',[RadioLogController::class,'store'])->name('radiolog.store');
    Route::get('/radiolog/{radiolog}/edit', [RadioLogController::class, 'edit'])->name('radiolog.edit');
    Route::put('/radiolog/{radiolog}/update', [RadioLogController::class, 'update'])->name('radiolog.update');
    Route::delete('/radiolog/{radiolog}/delete', [RadioLogController::class, 'delete'])->name('radiolog.delete');
    Route::get('/radiolog/print', [RadioLogController::class, 'print'])->name('radiolog.print');
    Route::get('/radiolog/export-pdf', [RadioLogController::class, 'exportPDF'])->name('radiolog.exportPDF');

     //OCD MIMAROPA Incoming Communications
    Route::get('/record', [RecordController::class, 'index'])->name('record.index');
    Route::get('/record/create', [RecordController::class, 'create'])->name('record.create');
    Route::post('/record', [RecordController::class, 'store'])->name('record.store');

    //Attendance Database

    Route::get('/guest/log',[GuestController::class, 'log'])->name('guest.log');
    Route::delete('/guest/{guest}/delete',[GuestController::class, 'delete'])->name('guest.delete');
    
    //Fecth Data from Other Controllers to Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});

require __DIR__.'/auth.php';
