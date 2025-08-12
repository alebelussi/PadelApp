@extends('layouts.app')

@section('title', 'Prenotazioni') <!-- TITOLO -->

@push('styles') <!-- AGGIUNTA STILI -->
    <link rel="stylesheet" href="{{ asset('css/pages/booking/viewBooking.css') }}"> 
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" /> 
@endpush

@section('header')
    @include('partials.navbar') <!-- MENU -->
@endsection

@section('content')

    @if(session('message'))  <!-- GESTIONE DEI MESSGGI / AVVISI CON IL MODALE -->
        <x-modals.message-modal :title="session('title')" :message="session('message')" />
    @endif

    <div class="container mt-150 mb-5">
        <h1 class="mt-5 h1-color fw-bold text-center">Calendario delle Prenotazioni</h1>
        <h4 class="mb-5 text-center text-muted fst-italic">Consulta lo storico e lo stato aggiornato delle tue prenotazioni.</h4>
        <div id="calendar" data-events-url="{{ route('booking.events') }}"></div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header position-relative">
                <h5 class="modal-title position-absolute top-50 start-50 translate-middle" id="modal-title">Titolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-subtitle pb-1" id="modal-subtitle">Dettagli Prenotazione: </h5>
                <ul id="modal-info-list">
                    <li id="modal-start"></li>
                    <li id="modal-end"></li>
                    <li id="modal-players"></li>
                    <li id="modal-racket"></li>
                </ul>
            </div>
            <div class="modal-footer">
                <form action="{{ route('booking.delete', ['bookingId' => $booking->id ?? null]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE') <!-- SIMULA LA RIMOZIONE -->
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')     <!-- SCRIPTS -->
    <script src="{{ asset('js/pages/successModal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="{{ asset('js/pages/booking/viewBooking.js') }}"></script> 
@endpush