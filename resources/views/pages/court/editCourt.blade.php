@extends('layouts.app')

@section('title', 'Modifica Campo') <!-- TITOLO -->

@push('styles') <!-- AGGIUNTA STILI -->
    <link rel="stylesheet" href="{{ asset('css/pages/court/formCourt.css') }}">
@endpush

@section('header')  
    @include('partials.navbar') <!-- MENU -->
@endsection

@section('content') <!-- CONTENT -->

    <div class="container-header">
        <h1 class="h1-color text-center mb-2 mt-5 pt-5 fw-bold text-primary">Modifica i dettagli del campo</h1>
        <h4 class="fst-italic text-center text-muted"> 
            Aggiorna le informazioni relative al campo selezionato.<br>
            Puoi modificare nome, descrizione, location, prezzo e molto altro.
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
        <form method="POST" action="{{ route('court.update', $court->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="row"> <!-- 1° RIGA -->
                    <!-- COLONNA DI SINISTRA: dimensione = metà row -->
                    <div class="col-md-6 p-5"> <!-- PADDING LUNGO Y SU OGNI ELEMENTO - py2 -->
                        <div class="form-group py-2">    <!-- NOME -->
                            <label for="inputName">Nome</label>
                            <input type="text" class="form-control" name="name" id="inputName" value="{{ $court->name }}" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- DESCRIZIONE -->
                            <label for="inputDescription">Descrizione</label>
                            <textarea type="text" class="form-control" name="description" id="inputDescription"  autocomplete="off" rows="3">{{ $court->description }}</textarea>
                        </div>
                        <div class="form-group py-2">    <!-- LOCATION -->
                            <label for="inputLocation">Location</label>
                            <input type="text" class="form-control" name="location" id="inputLocation" value="{{ $court->location }}" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- PREZZO -->
                            <label for="inputPrice">Prezzo € / h</label>
                            <input type="number" step="0.01" min="0.00" class="form-control" name="price_per_hour" id="inputPrice" value="{{ $court->price_per_hour }}" autocomplete="off" required>
                        </div>
                        <div class="form-group py-2">    <!-- ID DEL COMPLESSO-->
                            <label for="inputComplexId">Id del complesso</label>
                            <input type="number" class="form-control" name="complex_id" id="inputComplexId" value="{{ $court->complex_id }}" autocomplete="off" required>
                        </div>
                    </div>

                    <!-- COLONNA DI DESTRA: dimensione = metà row, display flex, column flex, allineamento a sinistra e centrato nella colonna -->
                    <div class="col-md-6 d-flex flex-column align-items-start justify-content-center bg-column">
                        <!-- PADDING LUNGO Y SU OGNI ELEMENTO-->
                        <div class="form-group py-3">    <!-- TIPO DI CAMPO -->
                            <label for="selectType">Tipo</label> <br>
                            <select class="custom-select" name="type" id="selectType" required>
                                <option value="" disabled selected>Seleziona un tipo</option>
                                <option value="indoor" @selected($court->type == 'indoor')>Indoor</option>
                                <option value="outdoor" @selected($court->type == 'outdoor')>Outdoor</option>
                            </select>
                        </div>
                        <div class="form-group py-3">    <!-- STATO DEL CAMPO -->
                            <label for="selectStatus">Stato del campo</label> <br>
                            <select class="custom-select" name="status" id="selectStatus" required>
                                <option selected disabled>Seleziona uno stato</option>
                                <option value="active" @selected($court->status == 'active')>Attivo</option>
                                <option value="inactive" @selected($court->status == 'inactive')>Inattivo</option>
                                <option value="maintenance" @selected($court->status == 'maintenance')>In Manutenzione</option>
                            </select>
                        </div>
                        <div class="form-group py-3">    <!-- IMMAGINE DI CARICAMENTO -->
                            <label for="image">Immagine del campo</label>
                            <input type="file" class="form-control mt-3" name="image_path" id="image">
                        </div>
                    </div>
                </div>

                <!-- 2° RIGA -->
                <div class="row text-center p-5">
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-color">Modifica</button>
                    </div>
                </div>
        </form>
    </div>
@endsection