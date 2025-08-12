@section('title', 'Modifica Profilo') <!-- TITOLO -->
<x-guest-layout>
    <!-- CSS specifico -->
    <link rel="stylesheet" href="{{ asset('css/auth/update.css') }}">
    <script src="{{ asset('js/auth/update_profile_validation.js') }}"></script>

    @if ($errors->any())
        <div class="status-message status-error mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('status'))
        <div class="status-message mb-4">
            Profilo aggiornato con successo!
        </div>
    @endif

    <a href="{{ route('profile.show') }}" class="btn btn-link d-flex align-items-center mb-3" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Torna indietro
    </a>
    <h1 class="text-center mb-4">{{ __('Modifica del profilo') }}</h1>
    

    <form id="profile-update-form" method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

       <!-- foto profilo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="mb-3">
                <x-label for="photo" value="{{ __('Foto Profilo') }}" class="form-label" />

                <div class="d-flex align-items-center gap-3">
                    <div class="profile-photo-container">
                        <img 
                            src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}" 
                            alt="Foto profilo"
                            class="rounded-circle profile-photo" 
                        />
                    </div>

                    <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png"
                        class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                </div>
                @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        <!-- Nome -->
        <div class="mb-3">
            <x-label for="name" value="{{ __('Nome') }}" class="form-label" />
            <x-input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                     type="text" name="name"
                     value="{{ old('name', auth()->user()->name) }}"
                     required autocomplete="name" />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cognome -->
        <div class="mb-3">
            <x-label for="surname" value="{{ __('Cognome') }}" class="form-label" />
            <x-input id="surname" class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}"
                     type="text" name="surname"
                     value="{{ old('surname', auth()->user()->surname ?? '') }}"
                     required autocomplete="family-name" />
            @error('surname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Data di nascita -->
        @php
            $birthDate = old('birth_date', optional(auth()->user())->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '');
        @endphp
        <div class="mb-3">
            <x-label for="birth_date" value="{{ __('Data di nascita') }}" class="form-label" />
            <x-input id="birth_date" class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
                     type="date" name="birth_date"
                     value="{{ $birthDate }}" required />
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Codice fiscale -->
        <div class="mb-3">
            <x-label for="fiscal_code" value="{{ __('Codice Fiscale') }}" class="form-label" />
            <x-input id="fiscal_code" class="form-control {{ $errors->has('tax_code') ? 'is-invalid' : '' }}"
                     type="text" name="tax_code"
                     value="{{ old('tax_code', auth()->user()->tax_code ?? '') }}" required />
            @error('tax_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Numero di telefono -->
        <div class="mb-3">
            <x-label for="phone" value="{{ __('Numero di telefono') }}" class="form-label" />
            <x-input id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                     type="tel" name="phone"
                     value="{{ old('phone', auth()->user()->phone ?? '') }}"
                     required autocomplete="tel" />
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pulsanti -->
        <div class="d-flex mt-4 gap-3 w-100 justify-content-center">
            <x-button class="btn btn-primary">
                {{ __('Aggiorna') }}
            </x-button>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">
                Elimina
            </button>

            <x-button class="btn btn-primary" type="button"
                onclick="window.location='{{ route('password.update.form') }}'">
                {{ __('Modifica Password') }}
            </x-button>
        </div>
    </form>

    <!-- Modal di conferma eliminazione -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Conferma eliminazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare il tuo account? <br> Questa azione è irreversibile.</p>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Conferma la password</label>
                            <input type="password" class="form-control" name="current_password" id="current_password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Elimina Definitivamente</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

