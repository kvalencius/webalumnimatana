<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- ***** Logo Start ***** -->
          <a href="/" class="logo">
            <img src="{{ asset('assets/images/logo_matana.png') }}" alt="Matana University" style="height: 40px; width: auto;">
          </a>
          <!-- ***** Logo End ***** -->

          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li class="scroll-to-section"><a href="/" class="active">Beranda</a></li>
            <li class="scroll-to-section"><a href="/tentang">Tentang Kami</a></li>
            <li class="scroll-to-section"><a href="/berita">Berita</a></li>
            <li class="scroll-to-section"><a href="/lowongan">Lowongan Pekerjaan</a></li>
            <li class="scroll-to-section"><a href="/events">Events</a></li>
          </ul>
          
          {{-- 
          <!-- Profile Picture & Auth Section -->
          <div class="header-auth" style="display: none; align-items: center; gap: 16px; margin-left: auto;">
            @auth
              <div style="position: relative;">
                @if(Auth::user()->profile_picture)
                  <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #6366f1; cursor: pointer;">
                @else
                  <div style="width: 40px; height: 40px; border-radius: 50%; background: #6366f1; display: flex; align-items: center; justify-content: center; cursor: pointer; color: white;">
                    <i class="fas fa-user"></i>
                  </div>
                @endif
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu-custom bg-white rounded shadow position-absolute" style="right: 0; top: 100%; width: 200px; display: none; z-index: 1000;">
                  <a href="/profil" class="d-block px-3 py-2 text-dark text-decoration-none border-bottom hover-bg-light">
                    <i class="fas fa-user mr-2"></i>Profil Saya
                  </a>
                  <a href="/logout" class="d-block px-3 py-2 text-danger text-decoration-none hover-bg-light">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                  </a>
                </div>
              </div>
            @else
              <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 6px; padding: 8px 16px;">
                <a href="/login" style="text-decoration: none; color: white; font-weight: 600;"><i class="fa fa-sign-in-alt"></i> Sign In Now</a>
              </div>
            @endauth
          </div>
          --}}

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const authDiv = document.querySelector('[style*="position: relative"]');
              if (authDiv) {
                const img = authDiv.querySelector('img') || authDiv.querySelector('div[style*="background: #6366f1"]');
                const dropdown = authDiv.querySelector('.dropdown-menu-custom'); // Perbaikan selector class
                if (img && dropdown) {
                  img.addEventListener('click', function() {
                    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
                  });
                  document.addEventListener('click', function(e) {
                    if (!authDiv.contains(e.target)) {
                      dropdown.style.display = 'none';
                    }
                  });
                }
              }
            });
          </script>

          <a class='menu-trigger'>
              <span>Menu</span>
          </a> 
          <!-- ***** Menu End ***** -->
        </nav>
      </div>
    </div>
  </div>
</header>