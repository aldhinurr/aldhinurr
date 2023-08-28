<?php
$status_color = [
  'Ajukan' => 'warning',
  'Draf' => 'secondary',
  'Tolak' => 'danger',
  'Setuju' => 'success',
];
?>

<!--begin::Action--->
<td class="text-center">
  <span class="badge badge-light-{{ $status_color[$model->status] }}">
    {{ $model->status }}
  </span>
</td>
<!--end::Action--->