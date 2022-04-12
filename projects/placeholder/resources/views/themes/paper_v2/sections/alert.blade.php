<?php
$flash = app('Modules\CongregateContract\Theme\FlashMessageInterface');

if ($flash->hasError()) {
  $flash_class = "danger";
  $flash_type = "Error!";
  $flash_notification = $flash->getError();
} elseif ($flash->hasWarning()) {
  $flash_class = "warning";
  $flash_type = "Warning!";
  $flash_notification = $flash->getWarning();
} elseif ($flash->hasInformation()) {
  $flash_class = "info";
  $flash_type = "Information!";
  $flash_notification = $flash->getInformation();
} elseif ($flash->hasSuccess()) {
  $flash_class = "success";
  $flash_type = "Success!";
  $flash_notification = $flash->getSuccess();
}
?>

@if(isset($flash_class))
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-register">
    <div class="modal-content alert alert-{{$flash_class}}">
      <div class="modal-header no-border-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title text-center">{{$flash_type}}</h3>
      </div>
      <div class="modal-body">
        {{$flash_notification['message']}}
      </div>
      <div class="modal-body">
        @isset ($flash_notification['context'])
        @foreach ($flash_notification['context'] as $context)
        {{$context}}
        </hr>
        @endforeach
        @endisset
      </div>
      <button type="button" class="btn-{{$flash_class}} btn-modal btn btn-round" data-dismiss="modal" aria-label="Close">
        Close
      </button>
    </div>
  </div>
</div>

<script>
  if (document.readyState) {
    window.addEventListener('load', function() {
      $('#loginModal').modal('show');
    })
  };
</script>
@endif