@extends('people::layouts.master')

@section('content')
    <h1>People Module</h1>

    <p>
        This view is loaded from module: {!! config('people.name') !!}
    </p>
@endsection
