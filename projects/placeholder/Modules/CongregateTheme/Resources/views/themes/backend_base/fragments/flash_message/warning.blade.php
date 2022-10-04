<?php
    $warning = $flash_message->getWarning();
?>
<div style="background-color: rgb(236, 236, 186)">
    <b>Warning: </b>{{ $warning['message'] }}
    @if($warning['context'])
       <hr />
       <ul>
       @foreach ($warning['context'] as  $value)
         <li> {{ $value }}
       @endforeach
       </ul>
    @endif
</div>
