@extends('congregateui::layouts.master')

<?php

use Modules\CongregateUi\Services\BreadcrumbService;

$messages = ["one", "two"];
BreadcrumbService::add("Example", "http://");
$crumbs = [["foo", "http://"], ["bar", "#"]];
?>

@section('content')
<h1>
    Component Examples
</h1>

<p> Component: Card </p>
<x-ui-base-card::closable header="Header" title="Title" header-bg-color="white">
    We are going here
</x-ui-base-card::closable>

<x-ui-base-card::closable header="Header" title="Title" header-bg-color="primary">
    We are going here
</x-ui-base-card::closable>

<x-ui-base-card::closable header="Header" title="Title" header-bg-color="danger" bg-color="primary">
    We are going here
</x-ui-base-card::closable>
<hr />

<p> Component: Button</p>
<div class="row">
    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-default", "btn-lg"])>Default</x-ui-base-button::button>
    </div>
    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-primary", "btn-lg"])>Default</x-ui-base-button::button>
    </div>
    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-success", "btn-sm"])>Default</x-ui-base-button::button>
    </div>
    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-success", "btn-lg", "btn-flat"])>Default</x-ui-base-button::button>
    </div>
    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-success", "btn-lg", "disabled"])>Default</x-ui-base-button::button>
    </div>

    <div class="col-2">
            <x-ui-base-button::button  @class(["btn-lg", "btn-lg", "btn-outline-primary"])>Default</x-ui-base-button::button>
    </div>
</div>
<hr />

<p> Component: Alert </p>
<div class="row">
    <div class="col-4">
        <x-ui-base-alert::alert title="Default" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::alert>
    </div>
    <div class="col-4">
        <x-ui-base-alert::success title="Success" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::success>
    </div>
    <div class="col-4">
        <x-ui-base-alert::secondary title="Secondary" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::secondary >
    </div>
</div>
<div class="row">
    <div class="col-4">
        <x-ui-base-alert::danger title="Danger" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::danger >
    </div>
    <div class="col-4">
        <x-ui-base-alert::warning title="Warning" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::warning >
    </div>
    <div class="col-4">
        <x-ui-base-alert::info title="Info" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::info >
    </div>
    <div class="col-4">
        <x-ui-base-alert::light title="Light" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::light>
    </div>
    <div class="col-4">
        <x-ui-base-alert::dark title="Dark" header-bg-color="white" :list="$messages">
            Alert Message
        </x-ui-base-alert::dark>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <x-ui-base-breadcrumb::breadcrumb :$crumbs></x-ui-base-breadcrumb::breadcrumb>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <x-ui-base-nav::nav></x-ui-base-nav::nav>
    </div>
</div>
@endsection
