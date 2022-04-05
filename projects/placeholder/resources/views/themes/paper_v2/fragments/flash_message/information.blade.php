<?php
    $info = $flash_message->getInformation();
?>

<div class="alert alert-info" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>
        {{ $info['message'] }}
    </p>
    @if($info['context'])
    <hr>
       <ul>
        @foreach ($info['context'] as  $value)
            <li> {{ $value }}
        @endforeach
       </ul>
    @endif
</div>
