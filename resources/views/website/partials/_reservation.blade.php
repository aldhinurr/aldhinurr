<div class="sidebar single-content-sidebar mb-0 mr-2">
  <div class="sidebar-widget single-content-widget">
    <div class="row justify-content-between m-0">
      <h3 class="title stroke-shape">Sewa</h3>
      <h4 id="is_available">
        <span class="badge badge-success">Tersedia</span>
      </h4>
    </div>
    <div class="sidebar-widget-item">
      <div class="contact-form-action">
        <form action="#" id="sewa">
          @csrf
          <div class="input-box">
            <div class="alert alert-danger label-text" id="alert" role="alert" style="display: none">
              A simple danger alert—check it out!
            </div>
          </div>
          <div class="input-box">
            <label class="label-text">Mulai</label>
            <div class="form-group">
              <span class="la la-calendar form-icon"></span>
              <input class="date-range form-control" type="text" name="daterange-single" id="start_date">
            </div>
          </div>
          <div class="input-box">
            <label class="label-text">Selesai</label>
            <div class="form-group">
              <span class="la la-calendar form-icon"></span>
              <input class="date-range form-control" type="text" name="daterange-single" id="end_date">
            </div>
          </div>
          <div class="total-price">
            <label class="d-flex justify-content-between align-items-center">Duration
              <span class="text-black font-weight-regular"><input type="text" id="duration" name="duration"
                  class="text-right" value="{{ old('duration') ?? '1' }}" readonly="readonly" />
                {{ $data->price_for }}</span>
            </label>
          </div>
          <div class="total-price">
            <label class="d-flex justify-content-between align-items-center">Biaya
              <span class="text-black font-weight-regular">Rp. <input type="text" id="fee"
                  class="num text-right" name="fee" value="{{ old('fee') ?? $data->price }}"
                  readonly="readonly" /></span></label>
          </div>
          <hr>
          <div class="input-box">
            <label class="label-text">Fasilitas</label>
            <div class="form-group">
              <select id="fasilitas" name="fasilitas" class="form-control w-100"></select>
              <div class="d-flex justify-content-end">
                <a href="#" id="add-fasilitas"
                  class="btn btn-small btn-primary text-center mt-2 col-lg-4">Tambah</a>
              </div>
            </div>
          </div>
          <h3 class="title stroke-shape">Fasilitas Tambahan</h3>
          <div id="extraServiceList">
            <label for="info-extra-service" id="info-extra-service">Tidak ada fasilitas tambahan.</label>
            {{-- <div class="custom-checkbox">
              <input type="checkbox" name="cleaning" id="cleaningChb" value="15.00" />
              <label for="cleaningChb" class="d-flex justify-content-between align-items-center">Cleaning
                Fee <span class="text-black font-weight-regular">$15</span></label>
            </div> --}}
          </div>
          <div class="total-price pt-3 d-flex justify-content-between">
            <label class="label-text">Total</label>
            <p class="d-flex align-items-center"><span class="font-size-17 text-black">Rp. <input type="text"
                  id="total" name="total" class="num text-right" value="{{ $data->price }}"
                  readonly="readonly" />
              </span>
            </p>
          </div>
        </form>
      </div>
    </div><!-- end sidebar-widget-item -->
  </div><!-- end sidebar-widget -->
  <div class="btn-box">
    <a href="#" id="submit-sewa" class="theme-btn text-center w-100 mb-2">Sewa</a>
  </div>
  <div class="footer-item text-center padding-top-20px">
    <ul class="list-items list--items">
      <li><a href="{{ route('website.rooms') }}">Lihat Ruangan Lainnya</a></li>
      <li><a href="{{ route('website.status') }}">Lihat Status Peminjaman</a></li>
    </ul>
  </div>
</div><!-- end sidebar -->
