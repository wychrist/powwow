<div @class($classes) {{ $attributes }} role="alert">
    <h5><i class="{{$icon}}"></i>{{ __($title) }}</h5>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <hr />

    {{ $slot }}

    @if (count($alertList))
    <ul>
        @foreach ($alertList as $entry)
        <li>{{ $entry}}</li>
        @endforeach
    </ul>
    @endif
</div>
