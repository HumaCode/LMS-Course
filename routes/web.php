<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';


// admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
   
    // profile
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');

    // logout
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
}); // end admin group middleware

// login admin
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');



// instructor group middleware
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'instructorDashboard'])->name('instructor.dashboard');
}); // end admin group middleware

// user
// Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
