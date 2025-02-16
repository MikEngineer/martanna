<div>
    <h3>Pagamento Prenotazione</h3>

    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (!$errorMessage)
        <div id="card-element" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>
        <br>
        <button id="pay-button" class="btn btn-primary">Paga</button>
    @endif
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    document.addEventListener('livewire:load', function () {
        if (document.getElementById('card-element')) {
            var stripe = Stripe("{{ env('STRIPE_KEY') }}");
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-element');

            document.getElementById('pay-button').addEventListener('click', async function () {
                var clientSecret = @json($clientSecret);
                const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: { card: card }
                });
                if (error) {
                    alert("Errore: " + error.message);
                } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                    Livewire.emit('paymentSuccessful', paymentIntent.id);
                }
            });
        }
    });
</script>