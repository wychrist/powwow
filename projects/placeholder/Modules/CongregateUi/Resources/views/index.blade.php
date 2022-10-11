@extends('congregateui::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('congregateui.name') !!}
    </p>
    <x-ui-base-card::closable header="Header" title="Title" header-bg-color="white">
        We are going here
    </x-ui-base-card::closable>
    <x-ui-base-alert::alert  title="This is a test" header-bg-color="white">
    </x-ui-base-alert::alert>
@endsection
