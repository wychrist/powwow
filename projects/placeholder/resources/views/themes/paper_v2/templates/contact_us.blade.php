@extends('theme_layout::landing')

@section('section1')
    <form method="post">
        @csrf
        <input type="text" name="data[first_name]" placeholder="John" /> <br/>
        <input type="text" name="data[last_name]" placeholder="Doe" /><br/>
        <input type="email" name="email" placeholder="doe@example.com" /><br/>
        <input type="hidden" name="type" value="general" /><br/>
        <textarea name="data[message]" placeholder="message"></textarea><br/>
        <input type="submit" value="Submit" />
    </form>
@endsection
