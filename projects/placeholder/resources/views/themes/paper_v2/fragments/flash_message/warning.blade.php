<?php
    $warning = $flash_message->getWarning();
?>

<div class="alert alert-warning" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>
        {{ $warning['message'] }}
    </p>
    @if($warning['context'])
    <hr>
       <ul>
        @foreach ($warning['context'] as  $value)
            <li> {{ $value }}
        @endforeach
       </ul>
    @endif
</div>
