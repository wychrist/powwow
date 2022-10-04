<?php
    $success = $flash_message->getSuccess();
?>
<div style="background-color: rgb(89, 197, 112)">
    <b>Success: </b>{{ $success['message'] }}
    @if($success['context'])
       <hr />
       <ul>
       @foreach ($success['context'] as  $value)
         <li> {{ $value }}
       @endforeach
       </ul>
    @endif
</div>
