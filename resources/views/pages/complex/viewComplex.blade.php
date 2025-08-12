@extends('layouts.app')

@section('title', 'Strutture Sportive') <!-- TITOLO -->

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

    @if(session('message'))
        <x-modals.message-modal :title="session('title')" :message="session('message')" />
    @endif

    <div class="container container-header py-5">
        <h1 class="h1-color text-center mb-2 fw-bold text-primary">I nostri complessi sportivi</h1>
        <h4 class="fst-italic mb-5 text-center text-muted">Scopri le strutture dove puoi prenotare i tuoi campi preferiti.</h4>
        
        <div class="row">
            @forelse ($complexes as $complex)
                <div class="col-md-4 mb-4 mt-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="row field-row py-1">
                                <div class="col-12">
                                    <h5 class="card-title text-center">{{ $complex->name }}</h5>
                                </div>
                            </div>
                            <div class="row field-row py-1">
                                <div class="col-12">
                                    <p class="card-text text-center">{{ $complex->description }}</p>
                                </div>
                            </div>
                            <div class="row field-row py-1">
                                <div class="col-12">
                                    <p class="card-text"><strong>Indirizzo:</strong> {{ $complex->address }}, {{ $complex->city }} ({{ $complex->postal_code }})</p>
                                </div>
                            </div>
                            <div class="row field-row py-1">
                                <div class="col-12">
                                    <p class="card-text"><strong>Email:</strong> {{ $complex->email }}</p>
                                </div>
                            </div>
                            <div class="row field-row py-1">
                                <div class="col-12">    
                                    <p class="card-text"><strong>Telefono:</strong> {{ $complex->phone }}</p>
                                </div>
                            </div>
                            <div class="row field-row py-1">
                                <div class="col-12">    
                                    <p class="card-text"><strong>Orari di apertura:</strong></p>
                                </div>
                            </div>
                            
                            <div class="row field-row">
                                <div class="col-12">
                                    @if (is_array($complex->opening_hours))
                                        <ul class="ps-3">
                                            @foreach ($complex->opening_hours as $day => $hours)
                                                <li>
                                                    <strong>{{ ucfirst($day) }}:</strong>
                                                    @if (is_string($hours))
                                                        {{ $hours === 'closed' ? 'Chiuso' : $hours }}
                                                    @elseif (is_array($hours) && isset($hours['open'], $hours['close']))
                                                        {{ $hours['open'] }} - {{ $hours['close'] }}
                                                    @else
                                                        <em>Non disponibile</em>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted fst-italic">Orari non disponibili.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(Auth::user() && Auth::user()->hasRole('admin'))
                            <div class="card-footer text-center">
                                <a href="{{ route('complex.edit', ['complexId' => $complex->id ?? null]) }}" class="btn btn-primary mt-2">
                                    Modifica
                                </a>

                                <a href="{{ route('complex.delete', ['complexId' => $complex->id ?? null]) }}" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$complex->id}}">
                                    Elimina
                                </a>

                                <x-modals.delete-modal :id="$complex->id" :name="$complex->name" route="{{ route('complex.delete', ['complexId' => $complex->id]) }}" />
                            </div>
                        @elseif(Auth::user() && Auth::user()->hasRole('user'))
                            <div class="card-footer text-center">
                                <a href="{{ route('court.show', ['complexId' => $complex->id ?? null]) }}" class="btn btn-primary mt-2">
                                    Prenota
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Nessun complesso disponibile.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/successModal.js') }}"></script>
    <script src="{{ asset('js/pages/complex/viewComplex.js') }}"></script>
@endpush
