<?php
    $error = $flash_message->getError();
?>

<div class="alert alert-danger" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>
        {{ $error['message'] }}
    </p>
    @if($error['context'])
    <hr>
       <ul>
        @foreach ($error['context'] as  $value)
            <li> {{ $value }}
        @endforeach
       </ul>
    @endif
</div>
