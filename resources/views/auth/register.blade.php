@section('title', 'Iscriviti') <!-- TITOLO -->
<x-guest-layout>
    <!-- Includo il CSS specifico per register ed il js -->
    <link rel="stylesheet" href="{{ asset('css/auth/registration.css') }}">
    <script src="{{ asset('js/auth/registration.js') }}"></script>

    <x-authentication-card>
        <!-- <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot> -->

        <!-- Visualizza errori generali -->
        <x-validation-errors class="mb-4 text-danger" />

        <h1 class="text-center mb-4">{{ __('Registrazione') }}</h1>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="auth-content">
            @csrf

            <h3 class="align-left mt-4 pt-2 mb-2">{{ __('Dati anagrafici') }}</h3>
            <div class="border-top mb-4"></div>

            <!-- Nome -->
            <div class="mb-3">
                <x-label for="name" value="{{ __('Nome') }}" class="form-label" />
                <x-input id="name" 
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autocomplete="off" />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Cognome -->
            <div class="mb-3">
                <x-label for="surname" value="{{ __('Cognome') }}" class="form-label" />
                <x-input id="surname" 
                    class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" 
                    type="text" 
                    name="surname" 
                    :value="old('surname')" 
                    required 
                    autocomplete="off" />
                @error('surname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Data di nascita -->
            <div class="mb-3">
                <x-label for="birth_date" value="{{ __('Data di nascita') }}" class="form-label" />
                <x-input id="birth_date" 
                    class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" 
                    type="date" 
                    name="birth_date" 
                    :value="old('birth_date')" 
                    required />
                @error('birth_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Genere -->
            <div class="mb-3">
                <x-label for="gender" value="{{ __('Genere') }}" class="form-label" />
                <select id="gender" name="gender" 
                    class="form-select {{ $errors->has('gender') ? 'is-invalid' : '' }}" 
                    required>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Maschio</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femmina</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Altro</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Telefono -->
            <div class="mb-3">
                <x-label for="phone" value="{{ __('Telefono') }}" class="form-label" />
                <x-input id="phone" 
                    class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" 
                    type="tel" 
                    name="phone" 
                    :value="old('phone')"
                    autocomplete="off" 
                    required />
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Codice fiscale -->
            <div class="mb-3">
                <x-label for="tax_code" value="{{ __('Codice Fiscale') }}" class="form-label" />
                <x-input id="tax_code" 
                    class="form-control {{ $errors->has('tax_code') ? 'is-invalid' : '' }}" 
                    type="text" 
                    name="tax_code" 
                    :value="old('tax_code')" 
                    maxlength="16" 
                    autocomplete="off" 
                    required />
                @error('tax_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <h3 class="align-left mt-5 pt-2">{{ __('Dati di accesso') }}</h3>
            <div class="border-top mb-4"></div>

            <!--immagine di profilo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="mb-3">
                    <x-label for="photo" value="{{ __('Foto Profilo') }}" class="form-label" />
                    <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <!-- Email -->
            <div class="mb-3">
                <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                <x-input id="email" 
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="off" />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                <x-input id="password" 
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="off" />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <x-label for="password_confirmation" value="{{ __('Conferma Password') }}" class="form-label" />
                <x-input id="password_confirmation" 
                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="off" />
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Termini e privacy -->
            <div class="form-check mb-3 mt-4">
                <x-checkbox id="terms" 
                    name="terms" 
                    class="form-check-input {{ $errors->has('terms') ? 'is-invalid' : '' }}" 
                    required />
                <label for="terms" class="form-check-label">
                    {!! __('Accetto i :terms_of_service e l\' :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-primary text-decoration-underline">Termini di Servizio</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-primary text-decoration-underline">Informativa sulla Privacy</a>',
                    ]) !!}
                </label>
                @error('terms')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Link login + pulsante registrazione -->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <a href="{{ route('login') }}" class="text-primary text-decoration-underline small mb-2 mb-sm-0">
                    {{ __('Già Registrato?') }}
                </a>

                <x-button class="btn-color btn-primary text-center">
                    {{ __('Registrati') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
