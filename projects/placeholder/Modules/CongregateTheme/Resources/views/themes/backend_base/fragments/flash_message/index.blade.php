@if ($flash_message->hasError())
    @include("backend_theme::fragments.flash_message.error")
@endif

@if ($flash_message->hasWarning())
    @include("backend_theme::fragments.flash_message.warning")
@endif

@if($flash_message->hasInformation())
    @include("backend_theme::fragments.flash_message.information")
@endif

@if ($flash_message->hasSuccess())
    @include("backend_theme::fragments.flash_message.success")
@endif


