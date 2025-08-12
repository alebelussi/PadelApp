@extends('layouts.app')

@section('title', 'Padel App')  <!-- TITOLO DELLA PAGINA -->

@push('styles') <!-- STILI -->
    <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endpush

@section('header')
    @include('partials.navbar') <!-- MENU -->
@endsection

@section('content')

    <!-- IMMAGINE DI BACKGROUND --->   
    <div class="image-bg"></div>

    <!-- 1° SEZIONE SULL'IMMAGINE-->
    <div id="section1" class="section watch">
        <h2 class="title fst-italic">Divertimento e sport a portata di mano!</h2> <br>
        <h4 class="subtitle">Scegli il campo perfetto e <br> prenota subito per un'esperienza indimenticabile</h4>
    </div>

    <!-- 2° SEZIONE-->
    <div id="panel" class="panel">
        <!-- INTESTAZIONE CAROSELLO -->
        <div class="panel-header text-center mb-4">
            <h2>Il tuo prossimo campo da padel ti aspetta!</h2> <br>
            <h4>Sfoglia le nostre strutture e trova il campo ideale per allenarti o divertirti con gli amici.</h4>
        </div>
        <!-- CAROSELLO -->
        <div id="carouselCourts" class="carousel slide" data-bs-ride="carousel">
            <!-- CARD DEL CAROSELLO-->
            <div class="carousel-inner text-center">
                @foreach($courts->chunk(3) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="row">
                                @foreach($chunk as $court)
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                        @if($court->image_path)
                                            @php
                                                if (\Illuminate\Support\Str::startsWith($court->image_path, 'courts/')) 
                                                    $url = asset('storage/' . $court->image_path);
                                                else {
                                                    $url = asset('image/pages/courts/' . $court->image_path);
                                                }
                                            @endphp
                                        @endif
                                            <img src="{{ $url }}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $court->name }}</h5>
                                                <p class="card-text">{{ $court->description }}</p>
                                                <p class="card-text"><small class="text-muted">{{ ucfirst($court->type) }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- INDICATORI DEL CAROSELLO -->
            <div class="carousel-indicators">
                @foreach($courts->chunk(3) as $chunkIndex => $chunk)
                    <button type="button" data-bs-target="#carouselCourts" data-bs-slide-to="{{ $chunkIndex }}" 
                        class="{{ $chunkIndex === 0 ? 'active' : '' }}" 
                        aria-current="{{ $chunkIndex === 0 ? 'true' : 'false' }}" 
                        aria-label="Slide {{ $chunkIndex + 1 }}">
                    </button>
                @endforeach
            </div>
            <!-- BUTTON NEL FOOTER DEL CAROSELLO -->
            <div class="text-center mt-4">
                @if(Auth::check())
                    <a href="{{ route('court.show.all') }}" class="btn btn-primary mt-4 text-center" role="button">
                        Visualizza
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mt-4 text-center" role="button">
                        Login
                    </a>
                @endif
            </div>
        </div>  

        <!-- SEZIONE CON LE CARD E IMMAGINE DI SFONDO -->
        <div class="container-fluid py-5 bg-image">
            <div class="container text-center">
            
                <div class="row g-4 h-100">

                    <!-- Card 1: CAMPI -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mt-3">Campi</h4>
                                <span class="d-block my-3 border-top border-primary w-25 mx-auto"></span>
                                <p class="card-text fs-5">Esplora i campi da padel disponibili, scegli il tuo preferito e preparati per la prossima partita.</p>
                                <a href="{{ route('court.show') }}" class="btn btn-primary text-center" role="button">
                                        Campi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: STRUTTURE -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mt-3">Strutture</h4>
                                <span class="d-block my-3 border-top border-primary w-25 mx-auto"></span>
                                <p class="card-text fs-5">Scopri le diverse aree del centro sportivo, ognuna con caratteristiche uniche pensate per offrirti il massimo comfort.</p>
                                <a href="{{ route('complex.show') }}" class="btn btn-primary text-center" role="button">
                                    Strutture
                                </a>
                            </div>
                        </div>
                    </div>
                
                    <!-- Card 3: PRENOTAZIONI -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mt-3">Prenotazioni</h4>
                                <span class="d-block my-3 border-top border-primary w-25 mx-auto"></span>
                                <p class="card-text fs-5">Gestisci facilmente le tue prenotazioni: verifica date, orari e aggiorna le tue scelte in pochi click.</p>
                                @if(Auth::check())
                                    <a href="{{ route('booking.show') }}" class="btn btn-primary mt-4 text-center" role="button">
                                        Visualizza
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary text-center" role="button">
                                        Login
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- 3° SEZIONE -->
    <div class="panel">
        <div class="container py-5">
            <!-- Sezione titolo e sottotitolo -->
            <div class="text-center mb-5">
        
                <p class="lead text-muted fst-italic">Padel</p>
                <h1 class="mb-5" style="color: #0D47A1">Le regole del gioco</h1>
            </div>

            <!-- Sezione 4 colonne con icone e testo -->
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Si gioca sempre in doppio <br> su un campo 10x20 metri.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="fa-solid fa-baseball"></i>
                    <p>Prima che la palla colpisca il vetro <br> o la grata dell' avversario, <br>deve sempre rimbalzare per terra.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="fa-solid fa-table-tennis-paddle-ball"></i>
                    <p>Il servizio può rimbalzare <br> sulla parete di vetro, <br> ma se rimbalza sulla grata <br> è un fallo.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="fa-solid fa-trophy"></i>
                    <p>Il punteggio si calcola <br> come a Tennis, 15/0, 30/0, <br> 40/0, pari, vantaggio.</p>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endpush
