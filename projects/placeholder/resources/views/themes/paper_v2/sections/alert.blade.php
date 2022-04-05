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

@if(isset($flash_class99))
<div class="alert {{$flash_class}} alert-dismissible fade show" role="alert">
  <strong>{{$flash_type}}</strong> {{$flash_notification['message']}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif


<div onload="open_alert_model()" class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-register">
    <div class="modal-content">
      <div class="modal-header no-border-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 class="text-muted">Welcome</h6>
        <h3 class="modal-title text-center">Paper Kit</h3>
        <p>Log in to your account</p>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Email</label>
          <input type="text" value="" placeholder="Email" class="form-control" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" value="" placeholder="Password" class="form-control" />
        </div>
        <button class="btn btn-block btn-round"> Log in</button>
      </div>
      <div class="modal-footer no-border-footer">
        <span class="text-muted  text-center">Looking <a href="javascript:;">create an account</a> ?</span>
      </div>
    </div>
  </div>
</div>

<script>
  function open_alert_model() {
    $('#loginModal').modal('show');
  }
</script>