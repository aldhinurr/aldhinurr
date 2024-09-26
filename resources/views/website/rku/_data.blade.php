@foreach ($rku as $rku)
    <div class="col-lg-4 responsive-column">
      <div class="card-item">
        <div class="card-img-top overflow-hidden" style="height: 300px; width: auto;">
            <a href="{{ route('website.rku.show', $rku->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                @if ($rku->layanan_gambars->first())
                    <div style="width: 100%; height: 100%; background-image: url('{{ asset($rku->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                @else
                    <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                @endif
            </a>
        </div>
        <div class="card-body">
          <h3 class="card-title">
            <a href="{{ route('website.rku.show', $rku->id) }}" id="link-detail">{{ $rku->name }}</a>
          </h3>
          <small> Unit Pengelola: {{ $rku->unit_pengelola }}</small>
          <div class="card-attributes">
            <ul class="d-flex align-items-center">
              <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Kapasitas">
                <i class="la la-users"></i><span>{{ number_format($rku->capacity) }} Orang</span>
              </li>
              <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Lantai">
                <i class="la la-building"></i><span>{{ number_format($rku->large) }}</span>
              </li>
            </ul>
          </div>
          <p class="card-meta">{{ $rku->address }}</p>
          <div class="card-price d-flex align-items-center justify-content-between">
            <p>
              <span class="price__num">
                @if ($rku->price == 0)
                  <!--Gratis-->
                @else
                  Rp. {{ number_format($rku->price, 0) }}
                @endif
              </span>
              @if ($rku->price != 0)
              <span class="price__text">Per {{ $rku->price_for }}</span>
              @endif
            </p>
            @if (in_array($rku->id, $is_sewa))
              <span class="price__text">Sedang Disewa</span>
            @else
              <a href="{{ route('website.rku.show', $rku->id) }}" id="link-detail" class="btn-text">
                Lihat<i class="la la-angle-right"></i>
              </a>
            @endif
          </div>
        </div>
      </div><!-- end card-item -->
    </div><!-- end col-lg-4 -->
  @endforeach
