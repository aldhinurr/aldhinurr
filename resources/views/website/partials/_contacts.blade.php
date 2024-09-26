<div class="single-content-item padding-top-40px padding-bottom-40px">
  <h3 class="title font-size-20">Kontak</h3>
  <div class="pl-0 pt-4">
    <div class="col-lg responsive-column">
      <div class="single-tour-feature d-flex align-items-center mb-3">
        <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
          <i class="la la-home"></i>
        </div>
        @if($data->unit_pengelola == "Direktorat Sarana dan Prasarana")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">CS Layanan Fasilitas Direktorat Sarana dan Prasarana, Gd. CRCS Lt. 5</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Jatinangor")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">CS Layanan Fasilitas Direktorat ITB Kampus Jatinangor, Jl. Let. Jen. Purn. Dr. (HC). Mashudi N0.1</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Cirebon")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">CS Layanan Fasilitas Direktorat ITB Kampus Cirebon, Blok 04 RT. 003/RW. 004 Desa Kebonturi</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Teknologi Informasi")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">CS Layanan Fasilitas Direktorat Teknologi Informasi, Gd. CRCS Lt. 4</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Pendidikan")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">CS Layanan Fasilitas Direktorat Pendidikan, Jl. Tamansari No. 10</h3>
        </div>
        @endif
      </div><!-- end single-tour-feature -->
    </div><!-- end col-lg -->
    <div class="col-lg responsive-column">
      <div class="single-tour-feature d-flex align-items-center mb-3">
        <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
          <i class="la la-envelope"></i>
        </div>
        @if($data->unit_pengelola == "Direktorat Sarana dan Prasarana")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">ditsp@itb.ac.id</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Jatinangor")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">sekretariat.jatinangor@itb.ac.id</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Cirebon")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">kampuscirebon@itb.ac.id</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Teknologi Informasi")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">it-helpdesk@itb.ac.id</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Pendidikan")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">sekre-ditdik@itb.ac.id</h3>
        </div>
        @endif
      </div><!-- end single-tour-feature -->
    </div><!-- end col-lg -->
    <div class="col-lg responsive-column">
      <div class="single-tour-feature d-flex align-items-center mb-3">
        <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
          <i class="la la-phone"></i>
        </div>
        @if($data->unit_pengelola == "Direktorat Sarana dan Prasarana")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">(022) 86010100</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Jatinangor")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">(022) 7798600</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat ITB Kampus Cirebon")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium"> - </h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Teknologi Informasi")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">+62-811-130-6666</h3>
        </div>
        @elseif($data->unit_pengelola == "Direktorat Pendidikan")
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">(022) 22536250</h3>
        </div>
        @endif
      </div><!-- end single-tour-feature -->
    </div><!-- end col-lg -->
    {{-- <div class="col-lg responsive-column">
      <div class="single-tour-feature d-flex align-items-center mb-3">
        <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
          <i class="la la-whatsapp"></i>
        </div>
        <div class="single-feature-titles">
          <h3 class="title font-size-15 font-weight-medium">082102203366</h3>
        </div>
      </div><!-- end single-tour-feature -->
    </div><!-- end col-lg --> --}}
  </div><!-- end row -->
</div><!-- end single-content-item -->
