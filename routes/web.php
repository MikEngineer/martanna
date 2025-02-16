<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Livewire\PaymentForm;
use App\Http\Livewire\AdminBookings;
use App\Http\Livewire\UserBookings;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contattaci
Route::get('/contattaci', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contattaci', [ContactController::class, 'send'])->name('contact.send');

// Pagina pubblica Prenotazioni (calendario)
Route::get('/prenotazioni', function () {
    return view('booking');
})->name('booking');

// Rotte protette (solo utenti loggati)
Route::middleware(['auth'])->group(function () {
    // Pagina di pagamento (accessibile se la prenotazione è confermata)
    Route::get('/pagamento/{booking}/{amount}', PaymentForm::class)->name('payment.form');

    // Area "I Miei" prenotazioni
    Route::get('/miei-prenotazioni', UserBookings::class)->name('user.bookings');
});

// Rotte Admin (solo per admin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/prenotazioni', AdminBookings::class)->name('admin.bookings');
});
