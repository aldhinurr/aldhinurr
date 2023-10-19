@foreach ($lapangan as $lapangan)
    <div class="col-lg-4 responsive-column">
      <div class="card-item">
        <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
          <a href="{{ route('website.lapangan.show', $lapangan->id) }}" id="link-detail" class="d-block">
            @if ($lapangan->layanan_gambars->first())
              <img src="{{ asset($lapangan->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
            @else
              <img src="https://source.unsplash.com/600x400?rooms" alt="hotel-img" />
            @endif
          </a>
        </div>
        <div class="card-body">
          <h3 class="card-title">
            <a href="{{ route('website.lapangan.show', $lapangan->id) }}" id="link-detail">{{ $lapangan->name }}</a>
          </h3>
          <div class="card-attributes">
            <ul class="d-flex align-items-center">
              <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Kapasitas">
                <i class="la la-users"></i><span>{{ $lapangan->capacity }} Orang</span>
              </li>
              <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luas">
                <i class="la la-expand"></i><span>{{ $lapangan->large }} m<sup>2</sup></span>
              </li>
            </ul>
          </div>
          <p class="card-meta">{{ $lapangan->address }}</p>
          <div class="card-price d-flex align-items-center justify-content-between">
            <p>
              <span class="price__num">
                @if ($lapangan->price == 0)
                  Gratis
                @else
                  Rp. {{ number_format($lapangan->price, 0) }}
                @endif
              </span>
              <span class="price__text">Per {{ $lapangan->price_for }}</span>
            </p>
            @if (in_array($lapangan->id, $is_sewa))
              <span class="price__text">Sedang Disewa</span>
            @else
              <a href="{{ route('website.lapangan.show', $lapangan->id) }}" id="link-detail" class="btn-text">
                Lihat<i class="la la-angle-right"></i>
              </a>
            @endif
          </div>
        </div>
      </div><!-- end card-item -->
    </div><!-- end col-lg-4 -->
  @endforeach
