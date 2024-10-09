<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/adminlogin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/adminlogin', [AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/content/{page}/edit', [ContentController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/content/{page}/save', [ContentController::class, 'save'])->name('admin.save');
   
    
    Route::get('/contact', [ContentController::class, 'showContactPage'])->name('contact.page');
   
});


// Route::get('/login', function () {
//      return abort(404);
// })->name('login');
// Route::get('/register', function () {
//      return abort(404);
// })->name('register');
// Route::get('/logout', function () {
//      return abort(404);
// })->name('logout');


