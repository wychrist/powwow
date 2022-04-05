<?php
    $information = $flash_message->getInformation();
?>
<div style="background-color: rgb(160, 240, 187)">
    <b>Information: </b>{{ $information['message'] }}
    @if($information['context'])
       <hr />
       <ul>
       @foreach ($information['context'] as  $value)
         <li> {{ $value }}
       @endforeach
       </ul>
    @endif
</div>
