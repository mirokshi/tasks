@component('mail::message')
# Tarea Pendiente

Se ha marcado com a pendiente la tarea:
{{--{{ $task->name }}--}}


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('tasks.manager_email') }}
@endcomponent
