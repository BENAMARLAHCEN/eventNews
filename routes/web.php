<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerifyController as AuthVerifyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VerifyController;
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





// home page
Route::get('/',[HomeController::class,'index'])->name('home');

// about page
Route::get('/about',[HomeController::class,'about'])->name('about');

// search
Route::get('/search',[HomeController::class,'search'])->name('search');

// contact page
Route::get('/contact',[HomeController::class,'contact'])->name('contact');

// faq page
Route::get('/faq',[HomeController::class,'faq'])->name('faq');

// blog page
Route::get('/blog',[HomeController::class,'blog'])->name('blog');

// Auth Routes

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::get('/register', [AuthController::class, 'create'])->name('register.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'store'])->name('register');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

// Admin Routes
// Route::middleware('admin')->group(function () {
    Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('/admin/events/published', [EventController::class, 'published'])->name('admin.events.published');
    Route::get('/admin/events/rejected', [EventController::class, 'rejected'])->name('admin.events.rejected');
    Route::put('/admin/events/{id}/accept', [EventController::class, 'accept'])->name('admin.events.accept');
    Route::put('/admin/events/{id}/reject', [EventController::class, 'reject'])->name('admin.events.reject');
// });

// organizer event crud path 'my_events'
route::get('/myEvents', [OrganizerEventController::class, 'index'])->name('organizer.events.index');
route::get('/details/{event}', [OrganizerEventController::class, 'show'])->name('events.show');
route::get('/myEvents/create', [OrganizerEventController::class, 'create'])->name('organizer.events.create');
route::post('/myEvents', [OrganizerEventController::class, 'store'])->name('organizer.events.store');
route::get('/myEvents/{event}/edit', [OrganizerEventController::class, 'edit'])->name('organizer.events.edit');
route::put('/myEvents/{event}', [OrganizerEventController::class, 'update'])->name('organizer.events.update');
route::delete('/myEvents/{event}', [OrganizerEventController::class, 'destroy'])->name('organizer.events.destroy');


// user crud
route::get('/users', [UserController::class, 'index'])->name('users.index');
route::get('/users/access/{id}', [UserController::class, 'edit'])->name('users.access');
route::put('/users/access/{id}', [UserController::class, 'restrictAccess'])->name('users.restrict.access');



// categories crud
route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// roles crud
route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
route::get('/roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/verify/{token}', [AuthVerifyController::class,'VerifyEmail']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Reservation Routes
Route::post('/reservations/{id}', [ReservationController::class, 'reservation'])->name('reservations.reserve');
Route::delete('/reservations/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel');
Route::put('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
Route::put('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
Route::post('/reservations/{id}/payment', [MollieController::class, 'mollie'])->name('reservations.payment');
Route::get('/payment/success', [MollieController::class, 'success'])->name('success');
Route::get('/payment/cancel', [MollieController::class, 'cancel'])->name('cancel');


Route::get('/myReservations', [ReservationController::class, 'spectatorReservations'])->name('reservations.spectator');
Route::get('/reservations', [ReservationController::class, 'organizerReservations'])->name('reservations.organizer');
Route::get('/reservations/approved', [ReservationController::class, 'approvedReservations'])->name('reservations.approved');
Route::get('/reservations/rejected', [ReservationController::class, 'rejectedReservations'])->name('reservations.rejected');
Route::get('/reservations/paid', [ReservationController::class, 'paid'])->name('reservations.paid');

// generate ticket
Route::get('/ticket/{id}', [ReservationController::class, 'ticket'])->name('tickets.generate');