@extends('layouts.app')

@section('title', 'Aggiungi Prenotazione') <!-- TITOLO -->

@push('styles') <!-- AGGIUNTA STILI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">  <!-- CSS di flatpickr -->
    <link rel="stylesheet" href="{{ asset('css/pages/booking/addBooking.css') }}">
@endpush

@section('header')
    @include('partials.navbar') <!-- MENU -->
@endsection

@section('content')

    <div class="container-header">
        <h1 class="h1-color text-center mb-2 mt-5 pt-5 fw-bold text-primary">Prenota il tuo campo da padel</h1>
        <h4 class="fst-italic text-center text-muted"> 
            Scegli il giorno, l’orario e il campo che preferisci per vivere la tua partita perfetta.<br>
            Non hai la racchetta? Nessun problema, puoi noleggiarla sul posto! 
        </h4>
    </div>

    <div class="container container-section mb-4 distance">

        @if($errors->any())
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Oh no!</strong> <a href="#" class="alert-link">Modifica alcuni campi </a> e riprova a inviare il modulo.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8 p-4">
                <!-- FORM -->
                <form method="POST" action="{{ route('booking.store', ['court' => $court]) }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-group py-2">   
                        <label for="inputDay">Giorno</label>
                        <input type="date" class="form-control" name="day" id="inputDay" placeholder="Inserisci il giorno" required>
                    </div>
                    <div class="form-group py-2">   
                        <label for="selectStartTime">Orario</label>
                        <select name="startTime" id="selectStartTime" class="form-control" required>
                            <option value="">Seleziona un orario</option>
                        </select>
                    </div>  
                    <div class="form-group py-2">   
                        <label for="selectNumberOfPlayer">Numero di giocatori</label>
                        <select name="numberOfPlayer" id="selectNumberOfPlayer" class="form-control" required>
                            <option value="">Seleziona il numero di giocatori</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                        </select>
                    </div>  
                    <div class="form-group mb-3 py-2" id="racketNeededGroup">
                        <label for="racketCount" class="form-label">
                            Hai bisogno di una racchetta?
                            <p class="form-text">Puoi scegliere se utilizzare la tua racchetta o noleggiarne una</p>
                        </label>
                        <select class="form-select" id="selectedRacketNeeded" name="selectedRacketNeeded" required>
                            <option value="" selected>Seleziona un'opzione</option>
                            <option value="1">Sì, voglio la racchetta</option>
                            <option value="0">No, non mi serve</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 d-none" id="racketCountContainer">
                        <label for="racketCount" class="form-label">Quante racchette ti servono?</label>
                        <select class="form-select" id="racketCount" name="racket_count"></select>
                    </div>

                    <div class="row text-center p-5">
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-color">Prenota</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS di flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- PASSAGGIO DEI DATI NECESSARI: prenotazioni presenti nel DB e orari di apertura della struttura -->
    @php
        $openingHoursJson = json_encode(optional($court->complex)->opening_hours ?? []);
        $bookingSlotsJson = json_encode($bookings->map(function ($b) {  /* Collection di oggetti Booking */
            return [
                'start' => $b->start_time->format('Y-m-d H:i'), /* Conversione da Carbon a stringhe per JS */
                'end' => $b->end_time->format('Y-m-d H:i')
            ];
        }));
    @endphp

    <script>
        const openingHours = JSON.parse('{!! $openingHoursJson !!}');
        const bookings = JSON.parse('{!! $bookingSlotsJson !!}');
    </script>

    <script src="{{ asset('js/pages/booking/addBooking.js') }}"></script>   <!-- SCRIPTS -->
    <script src="{{ asset('js/pages/successModal.js') }}"></script> <!-- SCRIPTS -->
@endpush

