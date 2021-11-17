@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
           {{ $title }}
        @endcomponent
    @endslot

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            {!! html_entity_decode($message) !!} 
        @endcomponent
    @endslot


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            {{ $footer }}
        @endcomponent
    @endslot
@endcomponent