<!-- NAVBAR -->
<nav id="mainNav" class="navbar navbar-expand-lg navbar-dark bg-transparent custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('homepage') }}"> <!-- LOGO -->
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent"> <!-- CONTENITORE MENU -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">

        {{-- Campi --}}
        @auth
          @if (Auth::user()->hasRole('admin'))
            <li class="nav-item dropdown">  <!-- CAMPI -->
              <a class="nav-link dropdown-toggle" href="#" id="campiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Campi</a>
              <ul class="dropdown-menu" aria-labelledby="campiDropdown">
                <li><a class="dropdown-item" href="{{ route('court.store') }}">Inserisci</a></li>
                <li><a class="dropdown-item" href="{{ route('court.show.all') }}">Visualizza</a></li>
              </ul>
            </li>
          @else 
            {{-- Utente non admin: link singolo senza dropdown --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('court.show.all') }}">Campi</a>
            </li>
          @endif
        @else
          {{-- Non autenticato, mostra solo visualizza --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('court.show.all') }}">Campi</a>
          </li>
        @endauth

        {{-- Strutture --}}
        @auth
          @if (Auth::user()->hasRole('admin'))
            <li class="nav-item dropdown">  <!-- STRUTTURE -->
              <a class="nav-link dropdown-toggle" href="#" id="struttureDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Strutture</a>
              <ul class="dropdown-menu" aria-labelledby="struttureDropdown">
                <li><a class="dropdown-item" href="{{ route('complex.store') }}">Inserisci</a></li>
                <li><a class="dropdown-item" href="{{ route('complex.show') }}">Visualizza</a></li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('complex.show') }}">Strutture</a>
            </li>
          @endif
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('complex.show') }}">Strutture</a>
          </li>
        @endauth

        {{-- Prenotazioni --}}
        @auth   <!-- PRENOTAZIONI -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('booking.show') }}">Prenotazioni</a>
            </li>
        @endauth

        {{-- Link per ospiti --}}
        @guest    
          <li class="nav-item">   <!-- PROFILO NON LOGGGATO -->
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
          </li>
        @endguest

        {{-- Dropdown utente loggato --}}
        @auth
          <li class="nav-item dropdown">  <!-- PROFILO LOGGATO -->
          <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <x-avatar class="profile-image" :user="Auth::user()" />
          </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profilo</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth

      </ul>

    </div>
  </div>
</nav>
