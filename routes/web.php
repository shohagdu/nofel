<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
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

Route::get('/clearCache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "All caches cleared!";
});

Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return "Storage Created Successfully";
});

Route::get('/send-email', [EmailController::class, 'sendEmail']);
Route::get('/sendSms', [EmailController::class, 'sendSms']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/registration', [HomeController::class, 'registration']);
Route::get('/Breastbdcon2024', [HomeController::class, 'Breastbdcon2024']);
Route::get('/internationalFaculty', [HomeController::class, 'internationalFaculty']);
Route::get('/scientificSession', [HomeController::class, 'scientificSession']);
Route::post('/updateWorkshopPaymentInfo', [HomeController::class, 'store']);
Route::get('/registrationSuccess/{id}', [HomeController::class, 'registrationSuccess']);
Route::get('/regSuccess/{id}', [HomeController::class, 'regSuccess']);
Route::get('/generateStorageLink', [HomeController::class, 'generateStorageLink']);
Route::get('/viewFacultyDetails/{id}', [HomeController::class, 'viewFacultyDetails']);
Route::get('/invitation', [HomeController::class, 'invitation']);

// Checkout (URL) User Part
Route::get('/bkash-pay', [BkashController::class, 'payment'])->name('url-pay');
Route::post('/bkash-create', [BkashController::class, 'createPayment'])->name('url-create');
Route::get('/bkash-callback', [BkashController::class, 'callback'])->name('url-callback');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/facultyMember', [AdminController::class, 'facultyMember'])->name('facultyMember');
    Route::get('/addNewFacultyMember', [AdminController::class, 'addNewFacultyMember'])->name('addNewFacultyMember');
    Route::get('/updateFacultyMember/{id}', [AdminController::class, 'updateFacultyMember'])->name('updateFacultyMember');
    Route::post('/updatedStoreFacultyMember', [AdminController::class, 'updatedStoreFacultyMember'])->name('updatedStoreFacultyMember');

    Route::get('/workshopApplicant', [AdminController::class, 'workshopApplicant'])->name('workshopApplicant');
    Route::get('/viewApplicant/{id}', [AdminController::class, 'viewApplicant'])->name('viewApplicant');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
