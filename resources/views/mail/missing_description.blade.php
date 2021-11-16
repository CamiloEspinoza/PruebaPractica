@component('mail::message')

El libro {{ $libro->title }} con id{{ $libro->id }} no tiene descripcion, necesita revision con urgencia.

@component('mail::button', ['url' => ''])
Ir ahora
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
