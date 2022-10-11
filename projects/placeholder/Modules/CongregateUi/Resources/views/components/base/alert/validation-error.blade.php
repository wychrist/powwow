@if ($errors->any())
<x-ui-base-alert::alert title="Whoops! Something went wrong." :type="$type" :list='$errors->all()'></x-ui-base-alert::alert>
@endif
