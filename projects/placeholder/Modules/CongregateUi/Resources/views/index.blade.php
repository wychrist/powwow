@extends('congregateui::layouts.master')

<?php

use Modules\CongregateUi\Services\BreadcrumbService;

$messages = ["one", "two"];
BreadcrumbService::add("Example", "http://");
$crumbs = [["foo", "http://"], ["bar", "#"]];
?>

@section('content')
<h1>Hello World</h1>

<p>
    This view is loaded from module: {!! config('congregateui.name') !!}
</p>
<x-ui-base-card::closable header="Header" title="Title" header-bg-color="white">
    We are going here
</x-ui-base-card::closable>
<x-ui-base-alert::alert title="This is a test" header-bg-color="white" :list="$messages">
</x-ui-base-alert::alert>

<x-ui-base-breadcrumb::breadcrumb :$crumbs></x-ui-base-breadcrumb::breadcrumb>
@endsection