@extends('layouts.app')

@section('title', 'Aggiungi Campo') <!-- TITOLO -->

@push('styles') <!-- AGGIUNTA STILI -->
    <link rel="stylesheet" href="{{ asset('css/pages/court/formCourt.css') }}">
@endpush

@section('header')  
    @include('partials.navbar') <!-- MENU -->
@endsection

@section('content') <!-- CONTENT -->

    @if(session('message')) <!-- MESSAGGIO DELL'OPERAZIONE --> 
        <x-modals.message-modal :title="session('title')" :message="session('message')" />
    @endif

    <div class="container-header">
        <h1 class="h1-color text-center mb-2 mt-5 pt-5 fw-bold">Aggiungi un nuovo campo da padel</h1>
        <h4 class="fst-italic text-center text-muted"> 
            Inserisci nome, descrizione, location, stato operativo e dati di pricing.<br>
            Carica un’immagine e assegna il campo al complesso corretto prima di salvare. 
        </h4>
    </div>

    <div class="container container-section mb-4">

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
        
        <!-- FORM -->
        <form method="POST" action="{{ route('court.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

                <div class="row"> <!-- 1° RIGA -->
                    <!-- COLONNA DI SINISTRA: dimensione = metà row -->
                    <div class="col-md-6 p-5"> <!-- PADDING LUNGO Y SU OGNI ELEMENTO - py2 -->
                        <div class="form-group py-2">    <!-- NOME -->
                            <label for="inputName">Nome del campo</label>
                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Inserisci il nome del campo" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- DESCRIZIONE -->
                            <label for="inputDescription">Descrizione</label>
                            <textarea class="form-control" name="description" id="inputDescription" placeholder="Inserisci una descrizione" autocomplete="off" rows="3"></textarea>
                        </div>
                        <div class="form-group py-2">    <!-- LOCATION -->
                            <label for="inputLocation">Location</label>
                            <input type="text" class="form-control" name="location" id="inputLocation" placeholder="Inserisci una location" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- PREZZO -->
                            <label for="inputPrice">Prezzo € / h</label>
                            <input type="number" step="0.01" min="0.00" class="form-control" name="price_per_hour" id="inputPrice" placeholder="Inserisci il prezzo" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- ID DEL COMPLESSO-->
                            <label for="inputComplexId">Id del complesso</label>
                            <input type="number" class="form-control" min="1" name="complex_id" id="inputComplexId" placeholder="Inserisci l'id del complesso" autocomplete="off" required>
                        </div>
                    </div>

                    <!-- COLONNA DI DESTRA: dimensione = metà row, display flex, column flex, allineamento a sinistra e centrato nella colonna -->
                    <div class="col-md-6 d-flex flex-column align-items-start justify-content-center bg-column">
                        <!-- PADDING LUNGO Y SU OGNI ELEMENTO-->
                        <div class="form-group py-3">    <!-- TIPO DI CAMPO -->
                            <label for="selectType">Tipo</label> <br>
                            <select class="custom-select" name="type" id="selectType" required>
                                <option value="" disabled selected>Seleziona un tipo</option>
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div class="form-group py-3">    <!-- STATO DEL CAMPO -->
                            <label for="selectStatus">Stato del campo</label> <br>
                            <select class="custom-select" name="status" id="selectStatus" required>
                                <option selected disabled>Seleziona uno stato</option>
                                <option value="active">Attivo</option>
                                <option value="inactive">Inattivo</option>
                                <option value="maintenance">In Manutenzione</option>
                            </select>
                        </div>
                        <div class="form-group py-3">    <!-- IMMAGINE DI CARICAMENTO -->
                            <label for="image">Immagine del campo</label>
                            <input type="file" class="form-control" name="image_path" id="image">
                        </div>
                    </div>
                </div>

                <!-- 2° RIGA -->
                <div class="row text-center p-5">
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-color">Aggiungi</button>
                    </div>
                </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/successModal.js') }}"></script>
@endpush