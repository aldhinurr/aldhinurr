@extends('layout.efacility.master')

@section('content')
@if(session('alert'))
    <div class="alert alert-danger text-center">
        <strong>{!! session('alert') !!}</strong>
    </div>
@endif

<style>
    .slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease;
    }

    .slide {
        flex: 0 0 100%;
    }

    .slide img {
        width: 100%;
        height: auto;
    }

    button.prev, button.next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: transparent;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        z-index: 1;
    }

    button.prev {
        left: 10px;
    }

    button.next {
        right: 10px;
    }

    /* Ensure the image and content divs stretch to equal height */
    .equal-height {
      display: flex;
    }

    .equal-height > [class*='col-'] {
      display: flex;
      flex-direction: column;
    }

    /* Make sure image box and content stretch */
    .image-box, .about-content {
      flex: 1;
    }

    /* Ensure the image scales correctly and crops on the right */
    .img__item {
      width: 100%;
      height: 100%;
      object-fit: cover; /* This ensures the image covers the entire area without distortion */
      object-position: left center; /* This ensures the image crops from the right */
    }

    /* Styling for the about-description paragraph */
    .about-description {
      background-color: #e9f3ff;
      border-radius: 10px;
      padding: 15px;
      flex: 1;
    }
</style>

<div class="slider-container">
    <div class="slider">
        <div class="slide">
        <img src="{{ asset('efacility/images/Slider01.jpg') }}" alt="Gambar 1">
        </div>
        <div class="slide">
        <img src="{{ asset('efacility/images/Slider02.jpg') }}" alt="Gambar 2">
        </div>
    </div>
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
</div>

<script>
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let currentIndex = 0;
    let intervalId;

    function goToSlide(index) {
        slider.style.transform = `translateX(-${index * 100}%)`;
        currentIndex = index;
    }

    function slideNext() {
        goToSlide(currentIndex < slides.length - 1 ? currentIndex + 1 : 0);
    }

    function slidePrev() {
        goToSlide(currentIndex > 0 ? currentIndex - 1 : slides.length - 1);
    }

    function startSlideShow() {
        intervalId = setInterval(slideNext, 5000);
    }

    function stopSlideShow() {
        clearInterval(intervalId);
    }

    nextBtn.addEventListener('click', () => {
        slideNext();
        stopSlideShow();
    });

    prevBtn.addEventListener('click', () => {
        slidePrev();
        stopSlideShow();
    });

    startSlideShow();
</script>

  <!-- ================================ START ABOUT AREA ================================= -->
  <section class="about-area section--padding overflow-hidden">
    <div class="container">
      <div class="row equal-height">
        <div class="col-lg-5 d-flex align-items-stretch">
          <div class="image-box about-img-box">
            <img src="{{ asset('efacility/images/img-facility.png') }}" alt="about-img" class="img__item img__item-1">
          </div>
        </div>
        <!-- end col-lg-6 -->
        <div class="col-lg-7 d-flex align-items-stretch">
          <div class="about-content pr-6">
            <div class="section-heading">
              <h2 class="sec__title">E-Facility</h2>
              <p class="about-description">
                E-Facility adalah sistem yang mengintegrasikan pelayanan fasilitas ITB, baik yang berbasis tarif (<i>rental based</i>) maupun non-tarif (<i>resource sharing based</i>), 
                bagi sivitas akademika ITB. Dengan mengutamakan konsep pemanfaatan fasilitas secara kolektif, 
                E-Facility memudahkan sivitas akademika ITB dalam mengakses, memesan, dan mengelola berbagai fasilitas kampus. 
                Sistem ini dirancang untuk meningkatkan efektivitas dan kenyamanan dalam penggunaan sumber daya kampus, 
                serta memastikan setiap anggota sivitas akademika ITB dapat memaksimalkan manfaat dari fasilitas yang tersedia.<br>
                <a href="{{ route('website.about') }}">Lihat Selengkapnya</a><br>
              </p>
            </div>
            <!-- end section-heading -->
          </div>
        </div>
        <!-- end col-lg-6 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- ================================ END ABOUT AREA ================================= -->

<!-- ================================ START LIST LAYANAN ================================= -->
<style>
  .icon-box {
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .icon-box:hover {
    background-color: #287dfa; 
  }

  .icon-box:hover .icon,
  .icon-box:hover .text {
    color: white !important;
  }
    .icon-box {
    cursor: pointer;
  }
</style>
  <section class="hotel-area section-bg padding-top padding-bottom-0px overflow-hidden">
    <div class="container">
      <div class="row padding-top-30px justify-content-md-center">
        <div class="col-lg-2 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center" onclick="window.open('/sewa-layanan', '_self')">
            <div class="info-content text-center">
              <i class="la la-key icon" style="font-size:60px;color:#287dfa;"></i>
              <div class="row padding-top-10px"></div>
              <span class="text">Sewa Layanan</span>
              <br><br>
            </div>
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-2 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center" onclick="window.open('/resource-sharing', '_self')">
            <div class="info-content text-center">
              <i class="la la-building icon" style="font-size:60px;color:#287dfa;"></i>
              <div class="row padding-top-10px"></div>
              <span class="text"><i>Resource Sharing</i></span>
              <br><br>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-2 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center" onclick="window.open('https://asrama.itb.ac.id/', '_blank')">
            <div class="info-content text-center">
              <i class="la la-home icon" style="font-size:60px;color:#287dfa;"></i>
              <div class="row padding-top-10px"></div>
              <span class="text">Layanan Asrama</span>
              <br><br>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-2 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center" onclick="window.open('/barang', '_self')">
            <div class="info-content text-center">
              <i class="la la-recycle icon" style="font-size:60px;color:#287dfa;"></i>
              <div class="row padding-top-10px"></div>
              <span class="text">Informasi Barang<br>Tidak Digunakan</span>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-2 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center" onclick="window.open('/uji-lab', '_self')">
            <div class="info-content text-center">
              <i class="la la-gear icon" style="font-size:60px;color:#287dfa;"></i>
              <div class="row padding-top-10px"></div>
              <span class="text">Uji Laboratorium</span>
              <br><br>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================ END LIST LAYANAN ================================= -->

  <!-- ================================  START GALLERY AREA  ================================= -->
  <style>
  .link-text {
      color: rgba(128, 128, 128, 0.5); /* Warna default: abu-abu transparan */
      font-weight: normal; /* Font-weight normal */
      cursor: pointer; /* Tambahkan kursor tautan */
  }
  .link-text-default {
      color: #000; /* Warna aktif: hitam */
      font-weight: bold; /* Font-weight bold */
  }
  #loading {
    display: none;
    text-align: center;
    height: 300px; /* Sesuaikan dengan tinggi galeri */
    line-height: 300px; /* Vertikal align tengah */
  }

  #loading img {
      vertical-align: middle;
      height: 100px; /* Ukuran gambar loading, sesuaikan dengan kebutuhan */
  }
  .section-padding {
      padding-top: 30px;
      padding-bottom: 30px;
      overflow: hidden;
  }
  .full-width-slider {
      position: relative;
      transition: opacity 0.5s ease-in-out;
      min-height: 300px; /* Sesuaikan dengan tinggi galeri */
  }
  .hidden {
      opacity: 0;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
  }
</style>
<section class="section-padding padding-top-30px padding-bottom-30px overflow-hidden">                                                                                                                                                                                                                                                                                                                                                                                        
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
                <span style="font-size: 25px; color: black;"><b>Galeri</b></span> &nbsp;
                <span class="link-text-default" onclick="showSlider('ruangan')">Ruangan</span> &nbsp;
                <span class="link-text" onclick="showSlider('asrama')">Asrama</span>
                <div class="row padding-top-10px"></div>
      </div> 
    </div> 
    <!-- end gallery-area -->
    
    <!-- Gambar loading -->
    <div id="loading">
      <img src="{{ asset('efacility/images/loading.svg') }}" alt="Loading...">
    </div>

    <div id="ruangan-slider" class="full-width-slider carousel-action">
        <!-- Slider untuk Ruangan -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-1.jfif') }}" data-caption="Showing image 1">
                <img src="{{ asset('efacility/images/image-slider-1.jfif') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-2.jfif') }}" data-caption="Showing image 2">
                <img src="{{ asset('efacility/images/image-slider-2.jfif') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-3.jfif') }}" data-caption="Showing image 3">
                <img src="{{ asset('efacility/images/image-slider-3.jfif') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <!-- Tambahkan gambar-gambar lainnya di sini -->
    </div>

    <div id="asrama-slider" class="full-width-slider carousel-action" style="display:none;">
        <!-- Slider untuk Asrama -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Inter.jpg') }}" data-caption="Showing image 1">
                <img src="{{ asset('efacility/images/Inter.jpg') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Jatinangor.jpg') }}" data-caption="Showing image 2">
                <img src="{{ asset('efacility/images/Jatinangor.jpg') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Kanayakan.jpg') }}" data-caption="Showing image 3">
                <img src="{{ asset('efacility/images/Kanayakan.jpg') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Kidang.jpg') }}" data-caption="Showing image 3">
                <img src="{{ asset('efacility/images/Kidang.jpg') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
            <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Sangkuriang.jpg') }}" data-caption="Showing image 3">
                <img src="{{ asset('efacility/images/Sangkuriang.jpg') }}" height="300" style="object-fit: cover;">
            </a>
        </div><!-- end full-width-slide-item -->
        <!-- Tambahkan gambar-gambar lainnya di sini -->
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Menampilkan slider ruangan secara default
    $('#ruangan-slider').show();

    // Mengubah gaya elemen saat diklik
    $('.link-text, .link-text-default').click(function() {
        $('.link-text-default').removeClass('link-text-default').addClass('link-text');
        $(this).removeClass('link-text').addClass('link-text-default');
    });

    // Fungsi untuk menampilkan slider dengan gambar loading
    window.showSlider = function(sliderType) {
        const targetSlider = sliderType === 'ruangan' ? '#ruangan-slider' : '#asrama-slider';
        const nonTargetSlider = sliderType === 'ruangan' ? '#asrama-slider' : '#ruangan-slider';

        $('#loading').show(); // Menampilkan gambar loading
        $(nonTargetSlider).addClass('hidden');
        setTimeout(function() {
            $(nonTargetSlider).hide();
            $(targetSlider).show().removeClass('hidden');
            $('#loading').hide(); // Menyembunyikan gambar loading setelah slider ditampilkan
        }, 500);
    }
});
</script>
<div class="row padding-top-10px"></div>
<!-- ================================  END GALLERY  ================================= -->


<!-- ============================================================================== DISABLE !!! ============================================================================== -->
<!-- ============================================================================== DISABLE !!! ============================================================================== -->
<!-- ============================================================================== DISABLE !!! ============================================================================== -->
{{--

<!-- ================================  START GALLERY AREA  ================================= -->
<section class="section-padding padding-top-20px padding-bottom-20px overflow-hidden">                                                                                                                                                                                                                                                                                                                                                                                        <div class="container">
    <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h4>Galeri Ruangan</h4>
                        <div class="row padding-top-10px">
            </div>
            </div> </div> </div>
      <div class="full-width-slider carousel-action">
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-1.jfif') }}"
            data-caption="Showing image 1">
            <img src="{{ asset('efacility/images/image-slider-1.jfif') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-2.jfif') }}"
            data-caption="Showing image 2">
            <img src="{{ asset('efacility/images/image-slider-2.jfif') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-3.jfif') }}"
            data-caption="Showing image 3">
            <img src="{{ asset('efacility/images/image-slider-3.jfif') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
      </div><!-- end full-width-slider -->
    </div>
<br>
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- <h2 class="sec__title">Galeri Asrama</h2> <br> -->
            <h4>Galeri Asrama</h4>
            <div class="row padding-top-10px">
            </div>
            </div> </div> </div>
            <div class="full-width-slider carousel-action">
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Inter.jpg') }}"
            data-caption="Showing image 1">
            <img src="{{ asset('efacility/images/Inter.jpg') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Jatinangor.jpg') }}"
            data-caption="Showing image 2">
            <img src="{{ asset('efacility/images/Jatinangor.jpg') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Kanayakan.jpg') }}"
            data-caption="Showing image 3">
            <img src="{{ asset('efacility/images/Kanayakan.jpg') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Kidang.jpg') }}"
            data-caption="Showing image 3">
            <img src="{{ asset('efacility/images/Kidang.jpg') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/Sangkuriang.jpg') }}"
            data-caption="Showing image 3">
            <img src="{{ asset('efacility/images/Sangkuriang.jpg') }}" height="300" style="object-fit: cover;">
          </a>
        </div><!-- end full-width-slide-item -->
      </div><!-- end full-width-slider -->
    </div>
  </section>
<br>  
<!-- end gallery-area -->
<!-- ================================ END GALLERY AREA ================================= -->

<!-- ================================ START INFO AREA ================================= -->
  <section class="info-area padding-bottom-20px">
    <div class="container">
      <div class="row padding-top-50px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-building"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_rooms }}</h4>
              <h3 class="info__title">Ruang</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        
        <!-- 
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-shuttle-van"></i>
            </div>
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_cars }}</h4>
              <h3 class="info__title">Kendaraan</h3>
            </div>
          </div>
        </div>
        -->

        <!-- end col-lg-4 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-map-signs"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_selasar }}</h4>
              <h3 class="info__title">Selasar</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-road"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_lapangan }}</h4>
              <h3 class="info__title">Lapangan</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
         <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $report_done }}</h4>
              <h3 class="info__title">Laporan Tertangani</h3>
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div> 
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================  END INFO AREA  ================================= -->
  <div class="section-block"></div>
  

 
<!-- ================================  START INFO AREA  ================================= -->
<section class="info-area padding-top-30px padding-bottom-70px">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="section-heading">
            <h2 class="sec__title">Lokasi</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-50px">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Ganesha</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Jatinangor</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Cirebon</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Jakarta</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-30px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">Bosscha</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <!-- <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div> -->
            <!-- end info-icon-->
            <!-- <div class="info-content mt-4">
              <h3 class="sec__title">Saraga</h3>
            </div> -->
            <!-- end info-content -->
          <!-- </div> -->
          <!-- end icon-box -->
        <!-- </div> -->
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section> 
  <!-- end info-area -->
  <!-- ================================  END INFO AREA  ================================= -->
  


  <!-- ================================  START ROOMS AREA  ================================= -->
  <section class="hotel-area section-bg padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- <h2 class="sec__title line-height-55"> -->
              <h4>
              Ruangan
            </h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rooms as $room)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="width: 100%; height: 250px;">
                      <a href="{{ route('website.room.show', $room->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($room->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($room->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.room.show', $room->id) }}">{{ $room->name }}</a>
                    </h3>
                    <small> Unit Pengelola: {{ $room->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $room->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $room->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $room->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($room->price == 0)
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($room->price, 0) }}
                          @endif
                        </span>
                        @if ($room->price != 0)
                          <span class="price__text">Per {{ $room->price_for }}</span>
                        @endif
                      </p>
                      @if ($room->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.room.show', $room->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.rooms') }}" class="theme-btn">Lihat Ruangan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
  <!-- end rooms-area -->
<!-- ================================  END RROMS AREA  ================================= -->


<!-- ================================  START RKU AREA  ================================= -->
<section class="hotel-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- <h2 class="sec__title line-height-55"> -->
              <h4>
              
            </h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rku as $rku)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
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
                      <a href="{{ route('website.rku.show', $rku->id) }}">{{ $rku->name }}</a>
                    </h3>
                    <small> Unit Pengelola: {{ $rku->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $rku->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $rku->large }} m<sup>2</sup></span>
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
                      @if ($rku->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.rku.show', $rku->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.rku') }}" class="theme-btn">Lihat Ruang Kuliah Umum Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================ END RKU AREA ================================= -->

<!-- <div class="section-block"></div> -->


<!-- ================================ START RUMAH SUSUN AREA ================================= -->
<section class="hotel-area section-bg padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- <h2 class="sec__title line-height-55"> -->
            <h4>
              Rumah Susun / Transit
            </h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rumah as $rumah)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                      <a href="{{ route('website.rumah.show', $rumah->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($rumah->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($rumah->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.rumah.show', $rumah->id) }}">{{ $rumah->name }}</a>
                    </h3>
                    <small> Unit Pengelola: {{ $rumah->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $rumah->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $rumah->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $rumah->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($rumah->price == 0)
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($rumah->price, 0) }}
                          @endif
                        </span>
                        @if ($rumah->price != 0)
                          <span class="price__text">Per {{ $rumah->price_for }}</span>
                        @endif
                      </p>
                      @if ($rumah->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.rumah.show', $rumah->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.rumah') }}" class="theme-btn">Lihat Rumah Susun / Transit Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================ END RUMAH SUSUN AREA ================================= -->


  <!-- ================================  START CAR AREA  ================================= -->
 <section class="hotel-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
  <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h4>Kendaraan</h4>
          </div>
        </div>
      </div>
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($cars as $car)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.car.show', $car->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($car->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($car->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?cars'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.car.show', $car->id) }}">{{ $car->name }}</a>
                  </h3>
                  <small> Unit Pengelola: {{ $car->unit_pengelola }}</small>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $car->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $car->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($car->price == 0)
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($car->price, 0) }}
                        @endif
                      </span>
                        @if ($car->price != 0)
                          <span class="price__text">Per {{ $car->price_for }}</span>
                        @endif
                    </p>
                    @if ($car->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.car.show', $car->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.cars') }}" class="theme-btn">Lihat Kendaraan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
  </section> 
<!-- end car-area -->
<!-- ================================ END CAR AREA ================================= -->


<!-- ================================ START SELASAR AREA ================================= -->
<section class="hotel-area section-bg padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- <h2 class="sec__title line-height-55"> -->
            <h4>
              Selasar
            </h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($selasar as $selasar)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                      <a href="{{ route('website.selasar.show', $selasar->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($selasar->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($selasar->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.selasar.show', $selasar->id) }}">{{ $selasar->name }}</a>
                    </h3>
                    <small> Unit: {{ $selasar->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $selasar->capacity }} zzzOrang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $selasar->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $selasar->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($selasar->price == 0)
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($selasar->price, 0) }}
                          @endif
                        </span>
                        @if ($selasar->price != 0)
                          <span class="price__text">Per {{ $selasar->price_for }}</span>
                        @endif
                      </p>
                      @if ($selasar->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.selasar.show', $selasar->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.selasar') }}" class="theme-btn">Lihat Selasar Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================ END SELASAR AREA ================================= -->

<!-- <div class="section-block"></div> -->

<!-- ================================ START LAPANGAN AREA ================================= -->
  <section class="car-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h4>Lapangan</h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($lapangan as $lapangan)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.lapangan.show', $lapangan->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($lapangan->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($lapangan->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.lapangan.show', $lapangan->id) }}">{{ $lapangan->name }}</a>
                  </h3>
                  <small> Unit: {{ $lapangan->unit_pengelola }}</small>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $lapangan->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $lapangan->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($lapangan->price == 0)
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($lapangan->price, 0) }}
                        @endif
                      </span>
                      @if ($lapangan->price != 0)
                        <span class="price__text">Per {{ $lapangan->price_for }}</span>
                      @endif
                    </p>
                    @if ($lapangan->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.lapangan.show', $lapangan->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            @endforeach
          </div>
          <!-- end lapangan-carousel -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.lapangan') }}" class="theme-btn">Lihat Lapangan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end lapangan-area -->
<!-- ================================ END LAPANGAN AREA ================================= -->

<!-- ================================ START PERALATAN AREA ================================= -->
<section class="car-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h4>Peralatan</h4>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($peralatan as $peralatan)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.peralatan.show', $peralatan->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($peralatan->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($peralatan->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.peralatan.show', $peralatan->id) }}">{{ $peralatan->name }}</a>
                  </h3>
                  <small> Unit: {{ $peralatan->unit_pengelola }}</small>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $peralatan->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $peralatan->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($peralatan->price == 0)
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($peralatan->price, 0) }}
                        @endif
                      </span>
                      @if ($peralatan->price != 0)
                        <span class="price__text">Per {{ $peralatan->price_for }}</span>
                      @endif
                    </p>
                    @if ($peralatan->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.peralatan.show', $peralatan->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            @endforeach
          </div>
          <!-- end peralatan-carousel -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.peralatan') }}" class="theme-btn">Lihat Peralatan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end peralatan-area -->
<!-- ================================ END PERALATAN AREA ================================= -->
<div class="section-block"></div>
--}}
<!-- ============================================================================== DISABLE !!! ============================================================================== -->
<!-- ============================================================================== DISABLE !!! ============================================================================== -->
<!-- ============================================================================== DISABLE !!! ============================================================================== -->

<!-- ================================ START LAPORAN AREA ================================= -->
  <section class="info-area padding-top-70px padding-bottom-70px" hidden>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="section-heading">
            <h2 class="sec__title">Laporan</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-30px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-bullhorn"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_waiting }}</h2>
              <h6 class="info__title">Kerusakan</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-recycle"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_process }}</h2>
              <h6 class="info__title">Proses</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_done }}</h2>
              <h6 class="info__title">Tertangani</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-4 text-center">
        <a href="{{ route('website.status') }}#my-laporan" class="theme-btn">Lihat Laporan <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================ END INFO AREA ================================= -->
@endsection
