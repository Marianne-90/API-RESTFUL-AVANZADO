<x-mail::message>
    # Hola {{ $user -> name }}

    Tu correo se ha actualizado porfavor verifícalo usando el siguiente enlace:

    <x-mail::button :url="route('verify', $user->verification_token)">
        Confirmar mi cuenta
    </x-mail::button>

    Gracias,<br>
    {{ config('app.name') }}
</x-mail::message>
