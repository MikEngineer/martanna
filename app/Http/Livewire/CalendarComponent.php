<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class CalendarComponent extends Component
{
    public $bookings;

    protected $listeners = ['bookingUpdated' => 'refreshBookings'];

    public function mount()
    {
        $this->refreshBookings();
    }

    public function refreshBookings()
    {
        $this->bookings = Booking::all();
    }

    public function requestBooking($date)
    {
        Booking::create([
            'date' => $date,
            'status' => 'pending',
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        $this->refreshBookings();

        // Questo dovrebbe funzionare perché "emit" è gestito da Livewire\Component tramite __call e Macroable.
        $this->emit('bookingUpdated');

        session()->flash('message', 'Richiesta di prenotazione inviata!');
    }

    public function render()
    {
        return view('livewire.calendar-component', [
            'bookingsJson' => $this->bookings->map(function ($booking) {
                return [
                    'title' => $booking->status === 'pending' ? 'Richiesta' : 'Occupato',
                    'start' => $booking->date,
                ];
            }),
        ]);
    }
}
