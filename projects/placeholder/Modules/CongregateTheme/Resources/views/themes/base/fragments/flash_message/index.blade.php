@if ($flash_message->hasError())
    @include("theme::fragments.flash_message.error")
@endif

@if ($flash_message->hasWarning())
    @include("theme::fragments.flash_message.warning")
@endif

@if($flash_message->hasInformation())
    @include("theme::fragments.flash_message.information")
@endif

@if ($flash_message->hasSuccess())
    @include("theme::fragments.flash_message.success")
@endif


