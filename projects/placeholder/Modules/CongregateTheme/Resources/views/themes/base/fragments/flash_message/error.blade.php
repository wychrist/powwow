<?php
    $error = $flash_message->getError();
?>
<div style="background-color: rgb(219, 64, 59)">
    <b>Error: </b>{{ $error['message'] }}
    @if($error['context'])
       <hr />
       <ul>
       @foreach ($error['context'] as  $value)
         <li> {{ $value }}
       @endforeach
       </ul>
    @endif
</div>
