@section('title', 'Termini & Condizioni') 
<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <!-- informativa sui termini di servizio in resource/markup -->
            <div class="wrapper-center">
                <div class="terms-container">
                {!! $terms !!}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>