  @foreach ($rooms as $room)
    <div class="col-lg-4 responsive-column">
      <div class="card-item">
        <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
          <a href="{{ route('website.room.show', $room->id) }}" class="d-block">
            @if ($room->layanan_gambars->first())
              <img src="{{ asset($room->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
            @else
              <img src="https://source.unsplash.com/600x400?rooms" alt="hotel-img" />
            @endif
          </a>
        </div>
        <div class="card-body">
          <h3 class="card-title">
            <a href="{{ route('website.room.show', $room->id) }}">{{ $room->name }}</a>
          </h3>
          <p class="card-meta">{{ $room->address }}</p>
          <div class="card-price d-flex align-items-center justify-content-between">
            <p>
              <span class="price__num">
                @if ($room->price == 0)
                  Gratis
                @else
                  Rp. {{ number_format($room->price, 0) }}
                @endif
              </span>
              <span class="price__text">Per {{ $room->price_for }}</span>
            </p>
            @if ($room->is_sewa > 0)
              <span class="price__text">Sedang Disewa</span>
            @else
              <a href="{{ route('website.room.show', $room->id) }}" class="btn-text">
                See details<i class="la la-angle-right"></i>
              </a>
            @endif
          </div>
        </div>
      </div><!-- end card-item -->
    </div><!-- end col-lg-4 -->
  @endforeach
