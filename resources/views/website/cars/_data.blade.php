  @foreach ($cars as $car)
    <div class="col-lg-4 responsive-column">
      <div class="card-item">
        <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
          <a href="{{ route('website.car.show', $car->id) }}" id="link-detail" class="d-block">
            @if ($car->layanan_gambars->first())
              <img src="{{ asset($car->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
            @else
              <img src="https://source.unsplash.com/600x400?cars" alt="hotel-img" />
            @endif
          </a>
        </div>
        <div class="card-body">
          <h3 class="card-title">
            <a href="{{ route('website.car.show', $car->id) }}" id="link-detail">{{ $car->name }}</a>
          </h3>
          <div class="card-attributes">
            <ul class="d-flex align-items-center">
              <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Kapasitas">
                <i class="la la-users"></i><span>{{ $car->capacity }} Orang</span>
              </li>
            </ul>
          </div>
          <p class="card-meta">{{ $car->address }}</p>
          <div class="card-price d-flex align-items-center justify-content-between">
            <p>
              <span class="price__num">
                @if ($car->price == 0)
                  Gratis
                @else
                  Rp. {{ number_format($car->price, 0) }}
                @endif
              </span>
              <span class="price__text">Per {{ $car->price_for }}</span>
            </p>
            @if (in_array($car->id, $is_sewa))
              <span class="price__text">Sedang Disewa</span>
            @else
              <a href="{{ route('website.car.show', $car->id) }}" id="link-detail" class="btn-text">
                Lihat<i class="la la-angle-right"></i>
              </a>
            @endif
          </div>
        </div>
      </div><!-- end card-item -->
    </div><!-- end col-lg-4 -->
  @endforeach
