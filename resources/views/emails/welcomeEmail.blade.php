@component('mail::message')
# Bienvenido a la aplicacion de gestion de tareas


@component('mail::button', ['url' => '/'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
