@component('mail::message')
# Contacto desde la Web
# Nombre:
{{$request->name}}
# Email:
{{$request->email}}
@component('mail::panel')
{{$request->message}}
@endcomponent
@endcomponent