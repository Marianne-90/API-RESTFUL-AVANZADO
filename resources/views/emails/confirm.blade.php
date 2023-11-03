Hola {{ $user -> name }}

Tu correo se ha actualizado porfavor verifícalo usando el siguiente enlace: 

{{ route('verify', $user->verification_token) }}