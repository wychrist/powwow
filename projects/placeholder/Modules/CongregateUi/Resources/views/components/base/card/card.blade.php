<div @class($classes)>
    <div class="card-header">
        @if($header)
            <h3 class="card-title">{{$header}}</h3>
        @endif
        <div class="card-tools">
            {{ $tools ?? '' }} @yield('tools')
            @if($collapsible)
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            @endif
            @if($closable)
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            @endif
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if($title)
            <h5 class="card-title">{{ $title}}</h5>
        @endif
        <div>
            {{ $slot }}
        </div>
    </div>
    <!-- /.card-body -->
    @if($footer)
    <div @class($footerClasses)>
        {{ $footer}}
    </div>
    @endif
    <!-- /.card-footer -->
</div>
<!-- /.card -->

