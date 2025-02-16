<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class UserBookings extends Component
{
    public $bookings;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::where('user_id', auth()->id())->get();
    }

    public function deleteBooking($bookingId)
    {
        $booking = Booking::find($bookingId);
        if ($booking && $booking->user_id == auth()->id()) {
            $booking->delete();
            session()->flash('message', 'Prenotazione eliminata.');
            $this->loadBookings();
        }
    }

    public function render()
    {
        return view('livewire.user-bookings');
    }
}
