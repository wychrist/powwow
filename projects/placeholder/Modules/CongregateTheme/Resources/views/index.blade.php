@extends('theme::layouts.two_columns_right')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('congregatetheme.name') !!}
    </p>
@endsection
