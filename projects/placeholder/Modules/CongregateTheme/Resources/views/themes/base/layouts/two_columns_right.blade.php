@extends('base_theme::layouts.main')

@section('body')
    <div class="">
        <div class="">
            @yield('content', '@section("content")')
        </div>
        <div class="">
            @yield('right', '@section("left")')
        </div>
    </div>
@endsection
