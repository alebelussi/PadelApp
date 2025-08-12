@section('title', 'Policy') 
<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <!-- informativa sulla privacy in resource/markup -->
            <div class="wrapper-center">
                <div class="terms-container">
                {!! $policy !!}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
