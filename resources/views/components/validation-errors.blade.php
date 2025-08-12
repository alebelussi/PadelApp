<!-- messaggio di errore -->
@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'alert alert-danger']) }} role="alert">
        <strong>{{ __('Ops! Qualcosa non va.') }}</strong>
    </div>
@endif
