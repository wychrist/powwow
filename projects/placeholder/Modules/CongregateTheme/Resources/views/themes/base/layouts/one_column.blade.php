@extends('base_theme::layouts.main')

@section('body')
    @sectionMissing('flash_message')
        @include("theme::fragments.flash_message.index")
    @else
        @yield('flash_message')
    @endif

    @yield('content', '@section("content")')
@endsection
