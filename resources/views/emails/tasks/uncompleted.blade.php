@component('mail::message')
# Tarea Completada

Se ha marcado como  pendiente la tarea:
{{--{{ $task->name }}--}}
:anger:

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('tasks.manager_email') }}
@endcomponent
