<!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="/" class="logo">
              <img src="assets/images/logo_matana.png" alt="Matana University">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="{{ url('/#forum') }}">Information</a></li>
              <li class="scroll-to-section"><a href="#about">Forum</a></li>
              @auth
                <li class="scroll-to-section"><a href="/profil">Profil</a></li>
                <li class="scroll-to-section"><a href="/alumni">List</a></li>
              @else
                <li class="scroll-to-section"><a href="/profil">Profil</a></li>
                <li class="scroll-to-section"><a href="/alumni">List</a></li>
                <li></li>
              @endauth
            </ul>

            <!-- Profile Picture & Auth Section -->
            <div class="header-auth d-flex align-items-center" style="gap: 1rem; margin-left: auto;">
              @auth
                <div class="profile-dropdown position-relative">
                  @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                      class="rounded-circle border border-primary" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;">
                  @else
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; cursor: pointer;">
                      <i class="fas fa-user text-white"></i>
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
                
                <style>
                  .profile-dropdown:hover .dropdown-menu-custom {
                    display: block !important;
                  }
                  .hover-bg-light:hover {
                    background-color: #f8f9fa;
                  }
                </style>
              @else
                <div class="gradient-button">
                  <a href="/login"><i class="fa fa-sign-in-alt"></i> Masuk</a>
                </div>
              @endauth
            </div>

            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->