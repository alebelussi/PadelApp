@section('title', 'Recupera Password') <!-- TITOLO -->
<x-guest-layout>
    <!-- CSS specifico per questa pagina -->
    @section('page-css')
        <link rel="stylesheet" href="{{ asset('css/auth/forgotpsw.css') }}">
    @endsection

    <!--<x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>-->

    <!--contenuto all’interno del contenitore centrale -->
    <h1 class="text-center mb-4">{{ __('Recupero della password') }}</h1>

   <div class="mb-3 text-muted">
        {!! __('Hai dimenticato la password? Tranquillo, capita.<br>Inserisci il tuo indirizzo email e riceverai un link per reimpostarla.') !!}
    </div>

    @session('status')
        <div class="text-success mb-3">
            {{ $value }}
        </div>
    @endsession

    <x-validation-errors class="text-danger mb-4" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!--mail per reimpostare la password -->
        <div class="mb-5">
            <x-label for="email" value="{{ __('Email') }}" />
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <!--bottone di reset -->
        <div class="text-center">
            <button type="submit" class="btn btn-color px-4 py-2">
                {{ __('Invia link di reset') }}
            </button>
        </div>
    </form>
</x-guest-layout>
