<x-mail::message>
# New Tickets
---------------
ticket title : {{ $ticket->title }}
--------------
ticket role  : {{ $ticket->role }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
