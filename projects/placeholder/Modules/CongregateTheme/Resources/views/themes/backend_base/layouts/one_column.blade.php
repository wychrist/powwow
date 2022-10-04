@extends('backend_base_theme::layouts.main')

@section('body')
    @sectionMissing('flash_message')
        @include("backend_theme::fragments.flash_message.index")
    @else
        @yield('flash_message')
    @endif

    @yield('content', '@section("content")')
@endsection
