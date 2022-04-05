@extends('theme::layouts.one_column')

@section('content')
    <h1>{{ $page->title }}</h1>
    <img src="{{$page->poster}}" style="width: 300px" />
    <hr />
    <i>
        {!! $page->intro !!}
    </i>
    <hr/>
        {!! $page->content !!}
@endsection
