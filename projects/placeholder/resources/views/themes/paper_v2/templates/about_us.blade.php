@extends('theme_layout::landing')


@isset($whoWeAre)
   @section('section1')
      @include('theme_section::image_text_alternating', ['page' => $whoWeAre])
   @endsection
@endisset

@section('section2')
    @include('theme_section::elders')
@endsection

@isset($communityInvolvement)
   @section('section3')
      @include('theme_section::image_text_alternating', ['page' => $communityInvolvement])
   @endsection
@endisset

@isset($history)
   @section('section4')
      @include('theme_section::image_text_alternating', ['page' => $history])
   @endsection
@endisset

