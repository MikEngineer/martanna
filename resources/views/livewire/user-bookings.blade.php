<div>
    <h2>Le mie prenotazioni</h2>

    @if (session()->has('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
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
                        <button wire:click="deleteBooking({{ $booking->id }})" class="btn btn-danger">Elimina</button>
                        <!-- Puoi aggiungere un pulsante per la modifica -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>