@extends('base_theme::layouts.main')

@section('body')
    <div>
        <div>
            @yield('left', '@section("left")')
        </div>
        <div>
            @sectionMissing('flash_message')
                @include("theme::fragments.flash_message.index")
            @else
                @yield('flash_message')
            @endif

            @yield('content', '@section("content")')
        </div>
    </div>
@endsection
