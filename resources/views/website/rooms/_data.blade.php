<div class="row" id="data-wrapper">
  @foreach ($rooms as $room)
    <div class="col-lg-4 responsive-column">
      <div class="card-item">
        <div class="card-img">
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
              <span class="price__num">Rp. {{ $room->price }}</span>
              <span class="price__text">Per {{ $room->price_for }}</span>
            </p>
            <a href="{{ route('website.room.show', $room->id) }}" class="btn-text">See details<i
                class="la la-angle-right"></i></a>
          </div>
        </div>
      </div><!-- end card-item -->
    </div><!-- end col-lg-4 -->
  @endforeach
  {{-- <div class="col-lg-4 responsive-column">
    <div class="card-item">
      <div class="card-img">
        <a href="hotel-single.html" class="d-block">
          <img src="images/img1.jpg" alt="hotel-img">
        </a>
        <span class="badge">Bestseller</span>
        <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Bookmark">
          <i class="la la-heart-o"></i>
        </div>
      </div>
      <div class="card-body">
        <h3 class="card-title"><a href="hotel-single.html">The Millennium Hilton New York</a></h3>
        <p class="card-meta">124 E Huron St, New york</p>
        <div class="card-rating">
          <span class="badge text-white">4.4/5</span>
          <span class="review__text">Average</span>
          <span class="rating__text">(30 Reviews)</span>
        </div>
        <div class="card-price d-flex align-items-center justify-content-between">
          <p>
            <span class="price__from">From</span>
            <span class="price__num">$88.00</span>
            <span class="price__text">Per night</span>
          </p>
          <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
        </div>
      </div>
    </div><!-- end card-item -->
  </div><!-- end col-lg-4 --> --}}
</div><!-- end row -->
