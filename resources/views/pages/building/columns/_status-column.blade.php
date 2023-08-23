<?php
$status_color = [
  'AKTIF' => 'success',
  'TIDAK AKTIF' => 'danger',
];
?>

<!--begin::Action--->
<td class="text-center">
  <span class="badge badge-light-{{ $status_color[$model->status] }}">
    {{ $model->status }}
  </span>
</td>
<!--end::Action--->