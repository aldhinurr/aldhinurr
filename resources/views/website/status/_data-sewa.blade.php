  @if ($sewa->total() > 0)
    @foreach ($sewa as $data)
      <tr>
        <th scope="row">
          @if ($data->layanan->type == 'RUANG')
            <i class="la la-building mr-1 font-size-18"></i>
          @else
            <i class="la la-car mr-1 font-size-18"></i>
          @endif
          {{ $data->layanan->type }}
        </th>
        <td>
          <div class="table-content">
            <h3 class="title">{{ $data->layanan->name }}</h3>
          </div>
        </td>
        <td>{{ $data->layanan->location }}</td>
        <td>{{ $data->start_date }}</td>
        <td>{{ $data->end_date }}</td>
        <td>{{ $data->user->first_name }} {{ $data->user->last_name }}</td>
        <td>{{ $data->status }}</td>
        <td>
          <div class="table-content">
            <a href="{{ route('website.reservation.show', $data->id) }}" class="theme-btn theme-btn-small">Detail</a>
          </div>
        </td>
      </tr>
    @endforeach
    <tr>
      <td colspan="8">
        <nav aria-label="Page navigation example">
          {{ $sewa->links('website.status._pagination-sewa') }}
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
