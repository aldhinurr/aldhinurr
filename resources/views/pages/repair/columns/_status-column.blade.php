<?php
$status_color = [
  'Ajukan' => 'warning',
  'Draft' => 'secondary',
  'Tolak' => 'danger',
  'Setuju' => 'success',
];
?>

<!--begin::Action--->
<td class="text-center">
  <span class="badge badge-{{ $status_color[$model->status] }}">
    {{ $model->status }}
  </span>
</td>
<!--end::Action--->