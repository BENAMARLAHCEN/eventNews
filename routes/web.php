<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StatisticController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');

// about page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// search
Route::get('/search', [HomeController::class, 'search'])->name('search');

// contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// faq page
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// blog page
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// event details
route::get('/details/{event}', [OrganizerEventController::class, 'show'])->name('events.show');

// verify email
Route::get('/verify/{token}', [AuthVerifyController::class, 'VerifyEmail']);

Route::middleware('guest')->group(function () {
    // Auth Routes

    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::get('/register', [AuthController::class, 'create'])->name('register.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'store'])->name('register');
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::middleware('auth')->group(function () {
    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware('role:admin')->group(function () {

        // statistic
        Route::get('/dashboard', [StatisticController::class, 'index'])->name('dashboard');
        // event
        Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index')->middleware('can:view-events');
        Route::get('/admin/events/published', [EventController::class, 'published'])->name('admin.events.published')->middleware('can:view-published-events');
        Route::get('/admin/events/rejected', [EventController::class, 'rejected'])->name('admin.events.rejected')->middleware('can:view-rejected-events');
        Route::put('/admin/events/{id}/accept', [EventController::class, 'accept'])->name('admin.events.accept')->middleware('can:accept-event');
        Route::put('/admin/events/{id}/reject', [EventController::class, 'reject'])->name('admin.events.reject')->middleware('can:reject-event');

        // user crud
        route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('can:view-users');
        route::get('/users/access/{id}', [UserController::class, 'edit'])->name('users.access')->middleware('can:edit-user-access');
        route::put('/users/access/{id}', [UserController::class, 'restrictAccess'])->name('users.restrict.access')->middleware('can:restrict-user-access ');


        // categories crud
        route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('can:view-categories');
        route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show')->middleware('can:show-category');
        route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('can:create-category');
        route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('can:store-category');
        route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('can:edit-category');
        route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('can:update-category');
        route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('can:delete-category');

        // roles crud
        route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('can:view-roles');
        route::get('/roles/{id}/show', [RoleController::class, 'show'])->name('roles.show')->middleware('can:show-role');
        route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:create-role');
        route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('can:store-role');
        route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:edit-role');
        route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:update-role');
        route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('can:delete-role');

        Route::get('/user/{id}/ban', [UserController::class, 'banneForm'])->name('user.banForm')->middleware('can:ban-user-form');
        Route::post('/user/{id}/banned', [UserController::class, 'banned'])->name('user.banned')->middleware('can:ban-user');
    });


    Route::middleware('role:organizer')->group(function () {
        // organizer event crud path 'my_events'

        route::get('/myEvents', [OrganizerEventController::class, 'index'])->name('organizer.events.index')->middleware('can:organizer-view-events');
        route::get('/myEvents/create', [OrganizerEventController::class, 'create'])->name('organizer.events.create')->middleware('can:organizer-create-event');
        route::post('/myEvents', [OrganizerEventController::class, 'store'])->name('organizer.events.store')->middleware('can:organizer-store-event');
        route::get('/myEvents/{event}/edit', [OrganizerEventController::class, 'edit'])->name('organizer.events.edit')->middleware('can:organizer-edit-event');
        route::put('/myEvents/{event}', [OrganizerEventController::class, 'update'])->name('organizer.events.update')->middleware('can:organizer-update-event');
        route::delete('/myEvents/{event}', [OrganizerEventController::class, 'destroy'])->name('organizer.events.destroy')->middleware('can:organizer-delete-event');

        // reservations to organizer
        Route::get('/reservations', [ReservationController::class, 'organizerReservations'])->name('reservations.organizer')->middleware('can:organizer-view-reservations');
        Route::get('/reservations/approved', [ReservationController::class, 'approvedReservations'])->name('reservations.approved')->middleware('can:organizer-view-approved-reservations');
        Route::get('/reservations/rejected', [ReservationController::class, 'rejectedReservations'])->name('reservations.rejected')->middleware('can:organizer-view-rejected-reservations');
        Route::get('/reservations/paid', [ReservationController::class, 'paid'])->name('reservations.paid')->middleware('can:organizer-view-paid-reservations');
        Route::put('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve')->middleware('can:organizer-approve-reservation');
        Route::put('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject')->middleware('can:organizer-reject-reservation');
    });






    Route::middleware('role:admin')->group(function () {
        // Reservation Routes
        Route::get('/myReservations', [ReservationController::class, 'spectatorReservations'])->name('reservations.spectator')->middleware('can:spectator-view-reservations');
        Route::post('/reservations/{id}', [ReservationController::class, 'reservation'])->name('reservations.reserve')->middleware('can:spectator-reserve');
        Route::delete('/reservations/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel')->middleware('can:spectator-cancel-reservation');
        Route::post('/reservations/{id}/payment', [MollieController::class, 'mollie'])->name('reservations.payment')->middleware('can:spectator-payment');
        Route::get('/payment/success', [MollieController::class, 'success'])->name('success')->middleware('can:spectator-payment');
        Route::get('/payment/cancel', [MollieController::class, 'cancel'])->name('cancel')->middleware('can:spectator-payment');
        // generate ticket
        Route::get('/ticket/{id}', [ReservationController::class, 'ticket'])->name('tickets.generate')->middleware('can:generate-ticket');
    });
});
