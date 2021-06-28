<?php

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

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/{id}/show', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
Route::put('/admin/user', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
Route::get('/admin/user/edit/password', [App\Http\Controllers\UserController::class, 'editPassword'])->name('admin.user.edit.password');
Route::put('/admin/user/edit', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('admin.user.update.password');

//Auth::routes();

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/admin/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/admin/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/admin/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/admin/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'Reset'])->name('password.update');

Route::get('/admin/event', [App\Http\Controllers\EventController::class, 'index'])->name('admin.event.index');
Route::get('/admin/eventr/create', [App\Http\Controllers\EventController::class, 'create'])->name('admin.event.create');
Route::post('/admin/event', [App\Http\Controllers\EventController::class, 'store'])->name('admin.event.store');
Route::get('/admin/event/{id}/show', [App\Http\Controllers\EventController::class, 'show'])->name('admin.event.show');
Route::get('/admin/event/{id}/edit', [App\Http\Controllers\EventController::class, 'edit'])->name('admin.event.edit');
Route::put('/admin/event/{id}', [App\Http\Controllers\EventController::class, 'update'])->name('admin.event.update');
Route::get('/admin/event/{id}/destroy', [App\Http\Controllers\EventController::class, 'destroy'])->name('admin.event.destroy');

Route::post('/admin/eventuser/{id}', [App\Http\Controllers\EventUserController::class, 'store'])->name('admin.eventuser.store');
Route::post('/admin/eventuser/{event_id}/destroy', [App\Http\Controllers\EventUserController::class, 'destroy'])->name('admin.eventuser.destroy');

Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.category.index');
Route::get('/admin/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('admin.category.create');
Route::post('/admin/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admin/category/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/admin/category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.category.update');
Route::get('/admin/category/{id}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.category.destroy');

Route::get('/admin/chat/{id}/talk', [App\Http\Controllers\ChatController::class, 'talk'])->name('admin.chat.talk');
Route::post('/admin/chat/{id}', [App\Http\Controllers\ChatController::class, 'store'])->name('admin.chat.store');