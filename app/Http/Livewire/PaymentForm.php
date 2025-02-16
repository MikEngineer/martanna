<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentForm extends Component
{
    public $bookingId;
    public $amount; // in centesimi
    public $clientSecret;
    public $errorMessage;

    protected $listeners = ['paymentSuccessful'];

    public function mount(Booking $booking, $amount)
    {
        if ($booking->status !== 'confirmed') {
            $this->errorMessage = 'La prenotazione non è confermata.';
            return;
        }
        $this->bookingId = $booking->id;
        $this->amount = $amount;
        $this->createPaymentIntent();
    }

    public function createPaymentIntent()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $this->amount,
            'currency' => 'eur',
            'metadata' => ['booking_id' => $this->bookingId],
        ]);

        $this->clientSecret = $paymentIntent->client_secret;
    }

    public function paymentSuccessful($paymentIntentId)
    {
        $booking = Booking::find($this->bookingId);
        if ($booking) {
            $booking->update([
                'status' => 'paid',
                'payment_intent_id' => $paymentIntentId,
            ]);
            session()->flash('message', 'Pagamento effettuato con successo!');
        }
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
