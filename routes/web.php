<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadioLogController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\OcdDirectoryController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\RisAdminCardController;
use App\Http\Controllers\TrainingdbController;
use App\Http\Controllers\LdrrmoController;
use App\Models\Record;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/directory', function() {
    return view('directory');
});

//ldrrmo
Route::get('/ldrrmo', [LdrrmoController::class, 'index'])->name('ldrrmo.index');
Route::get('/ldrrmo/create', [LdrrmoController::class, 'create'])->name('ldrrmo.create');
Route::post('/ldrrmo', [LdrrmoController::class, 'store'])->name('ldrrmo.store');

//updated directories
Route::get('/ocddirectory', [OcdDirectoryController::class, 'index'])->name('ocddirectory.index');
Route::get('/ocddirectory/create', [OcdDirectoryController::class, 'create'])->name('ocddirectory.create');
Route::post('/ocddirectory', [OcdDirectoryController::class, 'store'])->name('ocddirectory.store');

//Public Guest Log  
Route::get('/guest',[GuestController::class, 'index'])->name('guest.index');
Route::get('/guest/create',[GuestController::class, 'create'])->name('guest.create');
Route::post('/guest',[GuestController::class, 'store'])->name('guest.store');

//Public RIS e PDF 
Route::get('/risadmin/create',[RisAdminCardController::class, 'create'])->name('risadmin.create');
Route::post('/risadmin', [RisAdminCardController::class, 'store'])->name('risadmin.store');
Route::get('/risadmin/view/{id}', [RisAdminCardController::class, 'viewSinglePDF'])->name('risadmin.viewSingle');


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
    Route::get('/records/{id}/attachments', [RecordController::class, 'showAttachments'])->name('records.attachments');
    Route::get('/records/{id}', [RecordController::class, 'show'])->name('records.show');
    Route::get('/record/{record}/edit', [RecordController::class, 'edit'])->name('record.edit');
    Route::put('/record/{record}/update', [RecordController::class, 'update'])->name('record.update');
    Route::delete('/record/{record}/delete', [RecordController::class, 'delete'])->name('record.delete');

    //OCD MIMAROPA Outgoing Communications
    Route::get('/outgoing', [OutgoingController::class,'index'])->name('outgoing.index');
    Route::get('/outgoing/create', [OutgoingController::class, 'create'])->name('outgoing.create');
    //Route::get('/outgoing/developer', [OutgoingController::class, 'developer'])->name('outgoing.developer');
    Route::post('/outgoing', [OutgoingController::class, 'store'])->name('outgoing.store');
    Route::get('/outgoing/{id}', [OutgoingController::class, 'show'])->name('outgoing.show');
    Route::get('/outgoing/{id}/fileTwo', [OutgoingController::class, 'showFileTwo'])->name('outgoing.showFileTwo');
    Route::get('/outgoing/{outgoing}/edit', [OutgoingController::class, 'edit'])->name('outgoing.edit');
    Route::put('/outgoing/{outgoing}/update', [OutgoingController::class, 'update'])->name('outgoing.update');
    

    //Attendance Database
    Route::get('/guest/log',[GuestController::class, 'log'])->name('guest.log');
    Route::delete('/guest/{guest}/delete',[GuestController::class, 'delete'])->name('guest.delete');
    Route::get('/guest/export/{id}', [GuestController::class, 'exportSinglePDF'])->name('guest.exportSingle');
    
    //Fecth Data from Other Controllers to Dashboard`
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //RIS Admin Card
    Route::get('/risadmin',[RisAdminCardController::class, 'index'])->name('risadmin.index');
    Route::get('/risadmin/export/{id}', [RisAdminCardController::class, 'exportSinglePDF'])->name('risadmin.exportSingle');
    Route::delete('/risadmin/{risadmincard}', [RisAdminCardController::class, 'delete'])->name('risadmin.delete');

    

    //TrainingDB
    Route::get('/trainingdb', [TrainingdbController::class, 'index'])->name('trainingdb.index');
    Route::get('/trainingdb/create', [TrainingdbController::class, 'create'])->name('trainingdb.create');
    Route::post('/trainingdb', [TrainingdbController::class, 'store'])->name('trainingdb.store');
    Route::get('/trainingdb/{id}', [TrainingdbController::class, 'show'])->name('trainingdb.show');
    Route::get('/generate-ims-number', [TrainingdbController::class, 'generateIMSNumber'])->name('generate.ims.number');
    Route::delete('/trainingdb/{trainingdb}/delete', [TrainingdbController::class, 'delete'])->name('trainingdb.delete');

    //Module Loading

    Route::get('/developer', [DeveloperController::class, 'index'])->name('developer.index');


});
 
require __DIR__.'/auth.php';
