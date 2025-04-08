<x-mail::message>
{{-- Encabezado personalizado --}}
# Restablecimiento de contraseña

{{-- Mensaje principal --}}
Hemos recibido una solicitud para restablecer tu contraseña en {{ config('app.name') }}.

{{-- Botón de acción --}}
<x-mail::button :url="$actionUrl" color="primary">
Restablecer contraseña
</x-mail::button>

{{-- Mensaje alternativo --}}
Si no solicitaste este cambio, puedes ignorar este mensaje con toda seguridad.

{{-- Firma --}}
Saludos cordiales,<br>
El equipo de {{ config('app.name') }}

{{-- Subtexto con URL alternativa --}}
<x-slot:subcopy>
Si tienes problemas con el botón, copia y pega esta URL en tu navegador:
<span class="break-all">{{ $displayableActionUrl }}</span>
</x-slot:subcopy>
</x-mail::message>