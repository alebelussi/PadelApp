@section('title', 'Login') <!-- TITOLO -->

<x-guest-layout>
    <!-- Inserisco il CSS specifico per il login -->
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">

    <x-authentication-card>
        <!-- <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot> -->

        <x-validation-errors class="mb-4 text-danger" /> 

        @session('status')
            <div class="mb-4 font-medium text-sm text-success">
                {{ $value }}
            </div>
        @endsession

        <h1 class="text-center mb-4">{{ __('Login') }}</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Campo email -->
            <div class="mb-3">
                <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                <x-input id="email" 
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="email" />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <!-- Campo password -->
            <div class="mb-3">
                <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                <x-input id="password" 
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Checkbox per il ricordo della sessione -->
            <div class="form-check mb-3">
                <x-checkbox id="remember_me" name="remember" class="form-check-input" />
                <label for="remember_me" class="form-check-label">{{ __('Ricordati di me') }}</label>
            </div>

            <!-- Pulsante di login e link per il recupero della password -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                @if (Route::has('password.request'))
                    <a class="text-decoration-underline small text-primary mb-2 mb-sm-0" href="{{ route('password.request') }}">
                        {{ __('Hai dimenticato la password?') }}
                    </a>
                @endif

                <x-button  class="btn-color btn-primary text-center">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
