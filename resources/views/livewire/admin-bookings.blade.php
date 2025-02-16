<div>
    <h2>Gestione Prenotazioni</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Stato</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if($booking->status == 'pending')
                            <button wire:click="confirmBooking({{ $booking->id }})" class="btn btn-primary">Conferma</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>