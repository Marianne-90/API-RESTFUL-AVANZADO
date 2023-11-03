Hola {{ $user -> name }}

Gracias por crear una cuenta. Por favor verícala usando el siguiente enlace:

{{ route('verify', $user->verification_token) }}
