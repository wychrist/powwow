@extends('base_theme::layouts.main')

@section('body')
    <div class="">
        <div class="">
            @yield('left', '@section("left")')
        </div>
        <div class="">
            @yield('content', '@section("content")')
        </div>
    </div>
@endsection
