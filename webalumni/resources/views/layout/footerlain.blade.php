<style>
  .page-background-fixed {
    position: fixed!important;
    bottom: 0!important;
    left: 0!important;
    width: 100%!important;
    height: 100vh!important;
    background-image: url('{{ asset("assets/images/footer-bg.png") }}')!important;
    background-position: bottom center!important;
    background-repeat: no-repeat!important;
    background-size: cover!important;
    z-index: -1!important;
    pointer-events: none!important;
  }
  
  footer#contact-us {
    background-image: none !important;
    background-color: transparent !important;
    position: relative !important;
    z-index: 10 !important;
  }

  .container-footer {
    padding: 40px!important;
    border-radius: 8px!important;
    color: white!important;
  }

  .container-footer img {
    max-width: 200px!important;
  }
</style>

<div class="page-background-fixed"></div>

<footer id="contact-us">
<div>
<div class="container-footer wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
  <div class="row">
    <div class="col-lg-3 footer-widget">
      <img src="{{ asset('assets/images/logo-horizontal-white-footer.png') }}"
        alt="Matana University"
        class="mb-6"/>
      <p>
        <i class="fas fa-map-marker-alt"></i>
        <a href="https://maps.app.goo.gl/6P3uNLuaX7KJYjEH6">
          Matana University Tower, Jl. CBD Barat Kav. 1, Gading Serpong, Tangerang, Banten - 15810
        </a>
      </p>
      <p><i class="fas fa-phone"></i> <a href="tel:02129232999">021-2923-2999</a></p>
      <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/081287775999">0812-8777-5999</a></p>
      <p><i class="fas fa-envelope"></i> <a href="mailto:info@matanauniversity.ac.id">info@matanauniversity.ac.id</a></p>
    </div>
    <div class="col-lg-3 footer-widget">
      <h4>Contact Us</h4>
      <ul>
        <li><a href="#">Hubungi Kami</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Support</a></li>
      </ul>
    </div>
    <div class="col-lg-3 footer-widget">
      <h4>About This Web</h4>
      <ul>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="#">Informasi</a></li>
      </ul>
    </div>
    <div class="col-lg-3 footer-widget">
      <h4>Connect With Us</h4>
      <div class="flex space-x-3">
        <a href="https://www.facebook.com/MatanaUniversity/" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/matanauniversityofficial/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/channel/UCSTCRIr8NaFwD-5PSer4lZA/" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="https://www.linkedin.com/school/matana-university-alumni/" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>
  <div class="col-lg-12 copyright-text">
    <p>Copyright  2025 Matana University. All rights reserved.</p>
  </div>
  </div>
</div>
</footer>
