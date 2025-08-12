@extends('layouts.app')

@section('title', 'Campi da Padel') <!-- TITOLO -->

@push('styles') <!-- AGGIUNTA STILI -->
    <link rel="stylesheet" href="{{ asset('css/pages/court/cardCourt.css') }}">
@endpush

@section('header') 
    @include('partials.navbar')  <!-- MENU -->
@endsection

@section('content') <!-- CONTENT -->

    @if(session('message'))  <!-- GESTIONE DEI MESSGGI / AVVISI CON IL MODALE -->
        <x-modals.message-modal :title="session('title')" :message="session('message')" />
    @endif

    <!-- CONTAINER PRINCIPALE -->
    <div class="container container-header py-5">
        <h1 class="h1-color text-center mb-2 fw-bold text-primary">Scopri i nostri campi disponibili</h1>
        <h4 class="fst-italic mb-5 text-center text-muted"> Trova il campo perfetto per la tua partita,<br>  scegli tra le migliori strutture indoor e outdoor vicino a te.</h4>
        
        <div class="row">  <!--  RIGA -->
            @forelse ($courts as $court)
                <div class="col-md-4 mb-4 mt-3">
                    <div class="card h-100 shadow-sm">  <!-- CARD -->
                        @if($court->image_path)
                            @php
                                if (\Illuminate\Support\Str::startsWith($court->image_path, 'courts/')) 
                                    $url = asset('storage/' . $court->image_path);
                                else {
                                    $url = asset('image/pages/courts/' . $court->image_path);
                                }
                            @endphp

                        <div class="card-header header">
                            <img src="{{ $url }}" alt="{{ $court->name }}">
                        </div>
                            
                        @endif
                        <div class="card-body">  <!-- CARD BODY -->
                            <h5 class="card-title text-center">{{ $court->name }}</h5>
                            <p class="card-text text-center">{{ $court->description }}</p>
                            <p class="card-text"><strong>Tipo:</strong> {{ ucfirst($court->type) }}</p>
                            <p class="card-text"><strong>Prezzo/Ora:</strong> €{{ number_format($court->price_per_hour, 2) }}</p>
                            <p class="card-text"><strong>Stato:</strong> {{ ucfirst($court->status) }}</p>
                            <p class="card-text"><strong>Località:</strong> {{ $court->location }}</p>
                        </div>
                        @if(Auth::user())  <!-- SOLO PER ADMIN -->
                            <div class="card-footer text-center">    <!-- CARD FOOTER -->
                                @if(Auth::user()->hasRole('admin'))
                                    <a href="{{ route('court.edit', ['courtId' => $court->id ?? null]) }}" class="btn btn-primary mt-2 text-center" role="button">
                                        Modifica
                                    </a>
                                    
                                    <a href="{{ route('court.delete', ['courtId' => $court->id ?? null]) }}" class="btn btn-danger mt-2 text-center" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$court->id}}">
                                        Elimina
                                    </a>
                                    <x-modals.delete-modal :id="$court->id" :name="$court->name" route="{{ route('court.delete', ['courtId' => $court->id]) }}"/>
                                @else
                                    <a href="{{ route('booking.add', ['court' => $court]) }}" class="btn btn-primary mt-2 text-center" role="button">
                                        Prenota
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty   <!-- SE NON CI SONO CAMPI -->
                <div class="col-12">
                    <p class="text-center">Nessun campo disponibile.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')     <!-- SCRIPTS -->
    <script src="{{ asset('js/pages/successModal.js') }}"></script>
@endpush