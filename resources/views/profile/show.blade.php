@section('title', 'Profilo') <!-- TITOLO -->
<x-guest-layout>
    <!-- css specifico -->
    <link rel="stylesheet" href="{{ asset('css/auth/show.css') }}">

    <a href="{{ route('homepage') }}" class="btn btn-link d-flex align-items-center mb-3" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Torna indietro
    </a>

    <div class="max-w-3xl mx-auto py-12 px-8 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-10">
            {{ __('Profilo di') }} {{ Auth::user()->name }}
        </h2>

        <!-- immagine del profilo dell'utente centrata e rotonda -->
        <div class="profile-photo-container">
            <img src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
                alt="Foto profilo"
                class="profile-photo" />
        </div>

        <div class="bg-white rounded-lg p-6">
            <!-- info del profilo -->
            <div class="profile-container">
                <div class="profile-row">
                    <div class="label">Nome:</div>
                    <div class="value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Cognome:</div>
                    <div class="value">{{ Auth::user()->surname }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Email:</div>
                    <div class="value">{{ Auth::user()->email }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Data di nascita:</div>
                    <div class="value">{{ Auth::user()->birth_date->format('d/m/Y') }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Data creazione account:</div>
                    <div class="value">{{ Auth::user()->created_at->format('d/m/Y') }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Genere:</div>
                    <div class="value">{{ Auth::user()->gender == 'male' ? 'Maschio' : (Auth::user()->gender == 'female' ? 'Femmina' : 'Altro') }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Codice Fiscale:</div>
                    <div class="value">{{ Auth::user()->tax_code }}</div>
                </div>

                <div class="profile-row">
                    <div class="label">Telefono:</div>
                    <div class="value">{{ Auth::user()->phone }}</div>
                </div>
            </div>

           <!-- Contenitore Bottoni -->
           <div class="button-row">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    {{ __('Modifica Account') }}
                </a> 
            </div>
        </div>
    </div>

</x-guest-layout>

