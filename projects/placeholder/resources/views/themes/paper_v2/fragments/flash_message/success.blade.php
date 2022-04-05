<?php
    $success = $flash_message->getSuccess();
?>

<div class="alert alert-success" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>
        {{ $success['message'] }}
    </p>
    @if($success['context'])
    <hr>
       <ul>
        @foreach ($success['context'] as  $value)
            <li> {{ $value }}
        @endforeach
       </ul>
    @endif
</div>
