  @if ($report->total() > 0)
    @foreach ($report as $data)
      <tr>
        <td>{{ $data->created_at }}</td>
        <td>{{ $data->jenis }}</td>
        <td>{{ $data->keterangan }}</td>
        <td>{{ $data->user->first_name }} {{ $data->user->last_name }}</td>
        <td>{{ $data->status }}</td>
        <td>
          <div class="table-content">
            <a href="{{ route('website.report.show', $data->id) }}" class="theme-btn theme-btn-small">Detail</a>
          </div>
        </td>
      </tr>
    @endforeach
    <tr>
      <td colspan="8">
        <nav aria-label="Page navigation example">
          {{ $report->links('website.status._pagination-report') }}
        </nav>
      </td>
    </tr>
  @else
    <tr>
      <td colspan="8">
        <div class="table-content text-center">
          <h3 class="title">Tidak ada data.</h3>
        </div>
      </td>
    </tr>
  @endif
