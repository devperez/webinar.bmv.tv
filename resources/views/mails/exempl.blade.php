
@component('mail::message')

Bonjour {{ $name }},  {{-- use double space for line break --}}

Cliquez sur le bouton pour vous rendre sur le site :
@component('mail::button', ['url' => $link])
Accéder à la plateforme
@endcomponent
Cordialement,   
BMV Communication.
@endcomponent
