  @if ($repair->total() > 0)
    @php
      $status_color = [
          'Ajukan' => 'warning',
          'Draft' => 'secondary',
          'Tolak' => 'danger',
          'Setuju' => 'success',
      ];
    @endphp
    @foreach ($repair as $data)
      @if ($data->status == 'Draft' && !Auth::check())
        @continue
      @elseif ($data->status == 'Draft' && auth()->user()->email != $data->created_by)
        @continue
      @else
        <tr>
          <td>{{ $data->created_at }}</td>
          <td>
            <div class="text-dark">{{ $data->user->name }}</div>
            <div class="text-muted">{{ $data->user->email }}</div>
          </td>
          <td>
            <div class="text-dark">{{ $data->title }}</div>
            <div class="text-muted">{{ $data->unit }}</div>
          </td>
          <td>Rp. {{ number_format($data->total, 2) }}</td>
          <td>
            <span class="badge badge-{{ $status_color[$data->status] }}">
              {{ $data->status }}
            </span>
          </td>
          <td>
            @if ($data->status == 'Draft')
              <a href="{{ route('website.repair.edit', $data->id) }}" class="btn btn-sm btn-secondary">Ubah</a>
            @else
              <a href="{{ route('website.repair.show', $data->id) }}" class="btn btn-sm btn-primary">Lihat</a>
            @endif
          </td>
        </tr>
      @endif
    @endforeach
    <tr>
      <td colspan="8">
        <nav aria-label="Page navigation example">
          {{ $repair->links('website.status._pagination-repair') }}
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
