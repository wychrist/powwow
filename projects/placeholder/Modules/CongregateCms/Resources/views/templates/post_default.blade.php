@extends('theme::layouts.one_column')

@section('content')
    <h1>{{ $post->title }}</h1>
    <img src="{{$post->poster}}" style="width: 300px" />
    <hr />
    <i>
        {!! $post->intro !!}
    </i>
    <hr/>
        {!! $post->content !!}
@endsection
