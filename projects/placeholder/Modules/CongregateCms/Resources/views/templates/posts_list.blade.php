@extends('theme::layouts.one_column')

@section('content')
    <h1>List of posts</h1>
    <hr />
    @foreach ($list as $post)
        <h2><a href="{{ route('congregatecms.a_posts', ['id' => $post->slug]) }}">{{ $post->title }}</a></h2>
        <p>{!! $post->intro !!}</p>
    @endforeach
@endsection
