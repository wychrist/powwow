<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');
?>
<div class=" page-header section-dark" style="background-image: url(<?= $page->image ?>)">
  <div class="filter"></div>
  <div class="content-center">
    <div class="container">
      <div class="title-brand">
        <h1 class="presentation-title">{{ $page->title }}</h1>
      </div>
      <h2 class="presentation-subtitle text-center">{{ $page->subtitle }}</h2>
    </div>
  </div>
</div>