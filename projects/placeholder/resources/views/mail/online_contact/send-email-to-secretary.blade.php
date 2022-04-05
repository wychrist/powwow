@component('mail::message')

New Contact Information

First Name: {{ $data['first_name'] }} <br/>
Last Name: {{ $data['last_name'] }} <br/>
Email: {{ $email }} <br/>
Type: {{ $type }} <br/>
Message: {{ $data['message'] }} <br/>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
