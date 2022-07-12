@extends('theme::layouts.one_column')

@section('content')
    <h1>We couldn't find the post</h1>
    Below is a suggestion
    <hr />
    @foreach ($list as $post)
        <h2><a href="{{ route('congregatecms.a_posts', ['id' => $post->slug]) }}">{{ $post->title }}</a></h2>
        <p>{!! $post->intro !!}</p>
        @break;
    @endforeach
@endsection
