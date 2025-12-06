@extends ('layout.layout')

@section ('content')
<!-- Bagian Teks (Kiri) -->
    <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
      <div class="col-lg-6">
      <h2>Selamat Datang para Alumni, Mahasiswa dan Dosen Matana</h2>
      <p>Website ini dirancang untuk menghubungkan mahasiswa aktif, alumni dan dosen Matana.</p>
      </div>
      <div class="white-button first-button scroll-to-section">
        <li><div class="gradient-button"><a id="modal_trigger" href="/login"><i class="fa fa-sign-in-alt"></i> Masuk</a></div></li> 
      </div>
    </div>
@endsection

@section ('isiWebsite')
<div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Apa yang bisa kamu lakukan di Website ini?</h4>
            <img src="assets/images/heading-line-dec.png" alt="">
      
          </div>
        </div>
      </div>
    </div>

    <div class="container-services">
      <div class="row">

          <div class="service-item first-service">
            <div class="icon"></div>
            <h4>Life Updater</h4>
            <p>Berikan pembaruan terbaru tentang kehidupan Anda dengan mudah dan cepat.</p>
            <div class="text-button">
              <a href="#">Selengkapnya<i class="fa fa-arrow-right"></i></a>
            </div>
          </div>

          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Job Vacancy</h4>
            <p>Cari pekerjaan baru dengan mudah menggunakan koneksi anda.</p>
            <div class="text-button">
              <a href="#">Selengkapnya<i class="fa fa-arrow-right"></i></a>
            </div>
          </div>

          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Forum</h4>
            <p>Diskusikan berbagai topik dan berbagi informasi dengan mahasiswa aktif dan dosen-dosen matana.</p>
            <div class="text-button">
              <a href="#">Selengkapnya<i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        
    
          <div class="service-item fourth-service">
            <div class="icon"></div>
            <h4>Information</h4>
            <p>Informasi-informasi terbaru mengenai Matana University dan kegiatan sekitarnya.</p>
            <div class="text-button">
              <a href="#">Selengkapnya<i class="fa fa-arrow-right"></i></a>
            </div>
          </div>

      </div>
@endsection