@component('mail::message')
# Introduction

Hola {{ $user->name }}

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam at corporis dicta distinctio est eum eveniet expedita explicabo facilis fuga nulla quibusdam ratione repellendus saepe, sunt temporibus, vel voluptatem!

@component('mail::button', ['url' => ''])
Button Text
@endcomponent


@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
