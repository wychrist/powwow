<?php
$flash = app('Modules\CongregateContract\Theme\FlashMessageInterface');

if ($flash->hasError()) {
  $flash_class = "alert-danger";
  $flash_type = "Error!";
  $flash_notification = $flash->getError();
} elseif ($flash->hasWarning()) {
  $flash_class = "alert-warning";
  $flash_type = "Warning!";
  $flash_notification = $flash->getWarning();
} elseif ($flash->hasInformation()) {
  $flash_class = "alert-info";
  $flash_type = "Information!";
  $flash_notification = $flash->getInformation();
} elseif ($flash->hasSuccess()) {
  $flash_class = "alert-success";
  $flash_type = "Success!";
  $flash_notification = $flash->getSuccess();
}
?>

@if(isset($flash_class))
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-register">
    <div class="modal-content alert {{$flash_class}}">
      <div class="modal-header no-border-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title text-center">{{$flash_type}}</h3>
        <p>Log in to your account</p>
      </div>
      <div class="modal-body">
        {{$flash_notification['message']}}
      </div>
      @isset ($flash_notification['context'])
      <div class="modal-footer">
        @foreach ($flash_notification['context'] as $context)
        {{$context}}
        </hr>
        @endforeach
      </div>
      @endisset
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