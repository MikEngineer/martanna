<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class AdminBookings extends Component
{
    public $bookings;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::all();
    }

    public function confirmBooking($bookingId)
    {
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->update(['status' => 'confirmed']);
            session()->flash('message', 'Prenotazione confermata.');
            $this->loadBookings();
            $this->emit('bookingUpdated');
        }
    }

    public function render()
    {
        return view('livewire.admin-bookings');
    }
}
