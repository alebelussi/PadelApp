@section('title', 'Modifica Password') <!-- TITOLO -->
<x-guest-layout>
    <!-- CSS specifico -->
    <link rel="stylesheet" href="{{ asset('css/auth/update.css') }}">
    <script src="{{ asset('js/auth/password_validation.js') }}"></script>

    @if ($errors->any())
        <div class="status-message status-error mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('status'))
        <div class="status-message mb-4">
            {{ __('Password aggiornata con successo!') }}
        </div>
    @endif

    <a href="{{ route('profile.edit') }}" class="btn btn-link d-flex align-items-center mb-3" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Torna indietro
    </a>
    <h1 class="text-center mb-4">{{ __('Modifica della password') }}</h1>

    <form id="password-update-form" method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Password corrente -->
        <div class="mb-3">
            <x-label for="current_password" value="{{ __('Password corrente') }}" class="form-label" />
            <x-input id="current_password" type="password" name="current_password"
                     class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                     required autocomplete="current-password" />
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nuova password -->
        <div class="mb-3">
            <x-label for="password" value="{{ __('Nuova password') }}" class="form-label" />
            <x-input id="password" type="password" name="password"
                     class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                     required autocomplete="new-password" />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Conferma nuova password -->
        <div class="mb-3">
            <x-label for="password_confirmation" value="{{ __('Conferma nuova password') }}" class="form-label" />
            <x-input id="password_confirmation" type="password" name="password_confirmation"
                     class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                     required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pulsanti -->
        <div class="d-flex mt-4 gap-3 w-100 justify-content-center">
            <x-button class="btn btn-primary">
                {{ __('Salva') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>

