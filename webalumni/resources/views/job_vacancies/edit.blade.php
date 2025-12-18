<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan Kerja - Matana University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fbfc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ==================== NAVBAR ==================== */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #4b8ef1;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            height: 35px;
            width: auto;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #2d3748;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
            padding: 5px 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #4b8ef1;
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #4b8ef1;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #2d3748;
        }

        /* ==================== MAIN CONTENT ==================== */
        .edit-section-wrapper {
            flex: 1;
            padding-top: 140px;
            padding-bottom: 80px;
            position: relative;
            z-index: 1;
        }

        .edit-section-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #4b8ef1 0%, #a569bd 100%);
            z-index: -1;
            border-bottom-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .edit-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 45px;
            margin-top: 20px;
            animation: scaleIn 0.5s ease-out 0.2s backwards;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .edit-card h2 {
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 10px;
            text-align: center;
            font-size: 2.2rem;
        }

        .edit-card h2 em {
            color: #4b8ef1;
            font-style: normal;
        }

        .header-line {
            width: 60px;
            height: 4px;
            background: #4b8ef1;
            margin: 0 auto 25px;
            border-radius: 2px;
            animation: expandWidth 0.8s ease-out 0.3s both;
        }

        @keyframes expandWidth {
            from { width: 0; }
            to { width: 60px; }
        }

        .description {
            text-align: center;
            color: #718096;
            margin-bottom: 40px;
            font-size: 1.05rem;
        }

        /* ==================== FORM ==================== */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-12 {
            flex: 0 0 100%;
            padding: 0 10px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            padding: 0 10px;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-5 {
            margin-bottom: 2.5rem;
        }

        .form-group-animated {
            animation: slideUp 0.5s ease-out backwards;
        }

        .form-group-animated:nth-child(1) { animation-delay: 0.1s; }
        .form-group-animated:nth-child(2) { animation-delay: 0.15s; }
        .form-group-animated:nth-child(3) { animation-delay: 0.2s; }
        .form-group-animated:nth-child(4) { animation-delay: 0.25s; }
        .form-group-animated:nth-child(5) { animation-delay: 0.3s; }
        .form-group-animated:nth-child(6) { animation-delay: 0.35s; }
        .form-group-animated:nth-child(7) { animation-delay: 0.4s; }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label-pro {
            font-weight: 700;
            color: #4b8ef1;
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
            letter-spacing: 1px;
        }

        .input-pro {
            background: #f1f5f9;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
            font-family: inherit;
        }

        .input-pro:focus {
            background: #fff;
            border-color: #4b8ef1;
            box-shadow: 0 8px 15px rgba(75, 142, 241, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        textarea.input-pro {
            resize: vertical;
            min-height: 150px;
        }

        select.input-pro {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234b8ef1' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        /* ==================== BUTTONS ==================== */
        .text-center {
            text-align: center;
        }

        .btn-update-pro {
            background: linear-gradient(135deg, #4b8ef1 0%, #2b6ed1 100%);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(75, 142, 241, 0.3);
            width: 100%;
            margin-top: 10px;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-update-pro::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-update-pro:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-update-pro:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(75, 142, 241, 0.4);
        }

        .btn-update-pro:active {
            transform: translateY(-1px);
        }

        .btn-update-pro:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-cancel-pro {
            display: inline-block;
            color: #718096;
            text-decoration: none;
            margin-top: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            position: relative;
        }

        .btn-cancel-pro::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #2d3748;
            transition: width 0.3s ease;
        }

        .btn-cancel-pro:hover {
            color: #2d3748;
        }

        .btn-cancel-pro:hover::after {
            width: 100%;
        }

        /* ==================== ALERTS ==================== */
        .alert-success-custom {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease-out;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            animation: shake 0.5s ease-out;
            box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* ==================== FOOTER ==================== */
        .footer {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 2.5rem 2rem;
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.08);
            animation: slideUp 0.5s ease-out 0.6s backwards;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #718096;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            position: relative;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #4b8ef1;
            transition: width 0.3s ease;
        }

        .footer-link:hover {
            color: #4b8ef1;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .copyright {
            color: #a0aec0;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                gap: 1rem;
            }

            .nav-menu.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
            }

            .col-md-6 {
                flex: 0 0 100%;
            }

            .edit-card {
                padding: 30px 20px;
            }

            .edit-card h2 {
                font-size: 1.8rem;
            }

            .edit-section-wrapper {
                padding-top: 120px;
            }

            .navbar {
                padding: 1rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar">
        <div class="navbar-container">
           <a href="/" class="logo">
    <img src="{{ asset('assets/images/logo_matana.png') }}" alt="Matana University">
</a>

            <button class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="/" class="nav-link">Home</a></li>
                <li><a href="/information" class="nav-link">Information</a></li>
                <li><a href="/forum" class="nav-link">Forum</a></li>
                <li><a href="/profil" class="nav-link">Profil</a></li>
                <li><a href="/list" class="nav-link">List</a></li>
            </ul>
        </div>
    </nav>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="edit-section-wrapper">
        <div class="container">
            <div class="edit-card">
                <h2>Update <em>Lowongan</em> Kerja</h2>
                <div class="header-line"></div>
                <p class="description">Perbarui detail lowongan Anda untuk menarik kandidat terbaik.</p>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert-success-custom">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="alert-danger-custom">
                        <i class="fa fa-exclamation-circle"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin: 10px 0 0 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jobs.update', $job->id) }}" method="POST" id="editJobForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 mb-4 form-group-animated">
                            <label class="form-label-pro">Judul Lowongan</label>
                            <input type="text" 
                                   name="judul" 
                                   class="input-pro" 
                                   value="{{ old('judul', $job->judul) }}" 
                                   placeholder="Contoh: Backend Developer"
                                   required>
                        </div>

                        <div class="col-md-6 mb-4 form-group-animated">
                            <label class="form-label-pro">Nama Perusahaan</label>
                            <input type="text" 
                                   name="perusahaan" 
                                   class="input-pro" 
                                   value="{{ old('perusahaan', $job->perusahaan) }}" 
                                   placeholder="Contoh: PT. Tech Indonesia"
                                   required>
                        </div>

                        <div class="col-md-6 mb-4 form-group-animated">
                            <label class="form-label-pro">Lokasi</label>
                            <input type="text" 
                                   name="lokasi" 
                                   class="input-pro" 
                                   value="{{ old('lokasi', $job->lokasi) }}" 
                                   placeholder="Contoh: Jakarta, Indonesia"
                                   required>
                        </div>

                        <div class="col-md-6 mb-4 form-group-animated">
                            <label class="form-label-pro">Tipe Pekerjaan</label>
                            <select name="tipe_pekerjaan" class="input-pro" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Full Time" {{ old('tipe_pekerjaan', $job->tipe_pekerjaan) == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ old('tipe_pekerjaan', $job->tipe_pekerjaan) == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Internship" {{ old('tipe_pekerjaan', $job->tipe_pekerjaan) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Contract" {{ old('tipe_pekerjaan', $job->tipe_pekerjaan) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4 form-group-animated">
                            <label class="form-label-pro">Email Kontak</label>
                            <input type="email" 
                                   name="kontak_email" 
                                   class="input-pro" 
                                   value="{{ old('kontak_email', $job->kontak_email) }}" 
                                   placeholder="Contoh: hr@perusahaan.com"
                                   required>
                        </div>

                        <div class="col-12 mb-5 form-group-animated">
                            <label class="form-label-pro">Deskripsi & Persyaratan</label>
                            <textarea name="deskripsi" 
                                      class="input-pro" 
                                      rows="6" 
                                      placeholder="Jelaskan deskripsi pekerjaan dan persyaratan yang dibutuhkan..."
                                      required>{{ old('deskripsi', $job->deskripsi) }}</textarea>
                        </div>

                        <div class="col-12 text-center form-group-animated">
                            <button type="submit" class="btn-update-pro" id="submitBtn">
                                <i class="fa fa-save"></i> SIMPAN PERUBAHAN
                            </button>
                            <a href="{{ route('jobs.my-jobs') }}" class="btn-cancel-pro" id="cancelBtn">
                                <i class="fa fa-times"></i> Batalkan & Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer id="contact-us">
  <div>
    <div class="container-footer wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <div class="row">

        <div class="col-lg-3 footer-widget">
          <img src="{{ asset('assets/images/logo-horizontal-white-footer.png') }}"
               alt="Matana University"
               class="h-12 mb-6"/>

          <p>
            <i class="fas fa-map-marker-alt"></i>
            <a href="https://maps.app.goo.gl/6P3uNLuaX7KJjEH6">
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
            <a href="https://www.facebook.com/MatanaUniversity/"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/matanauniversityofficial/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCSTCRIr8NaFwD-5PSer4lZA/"><i class="fab fa-youtube"></i></a>
            <a href="https://www.linkedin.com/school/matana-university-alumni/"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>

      </div>

      <div class="col-lg-12 copyright-text">
        <p>Copyright © 2025 Matana University. All rights reserved.</p>
      </div>

    </div>
  </div>
</footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('navMenu');
            menu.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editJobForm');
            const submitBtn = document.getElementById('submitBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const inputs = document.querySelectorAll('.input-pro');
            
            // Form Submit Handler
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner spinner"></i> Menyimpan...';
            });
            
            // Cancel Confirmation
            cancelBtn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin membatalkan perubahan?\n\nSemua perubahan yang belum disimpan akan hilang.')) {
                    e.preventDefault();
                }
            });
            
            // Input Focus Animation
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transition = 'transform 0.3s ease';
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
            
            // Auto-hide success message
            const successAlert = document.querySelector('.alert-success-custom');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s ease';
                    successAlert.style.opacity = '0';
                    setTimeout(() => successAlert.remove(), 500);
                }, 5000);
            }
            
            // Real-time email validation
            const emailInput = document.querySelector('input[name="kontak_email"]');
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    if (this.value && !this.validity.valid) {
                        this.style.borderColor = '#f56565';
                    } else {
                        this.style.borderColor = '';
                    }
                });
            }
            
            // Character counter for textarea
            const textarea = document.querySelector('textarea[name="deskripsi"]');
            if (textarea) {
                const counter = document.createElement('small');
                counter.style.color = '#718096';
                counter.style.display = 'block';
                counter.style.marginTop = '5px';
                counter.style.textAlign = 'right';
                textarea.parentElement.appendChild(counter);
                
                function updateCounter() {
                    const length = textarea.value.length;
                    counter.textContent = `${length} karakter`;
                    
                    if (length < 50) {
                        counter.style.color = '#f56565';
                    } else if (length < 100) {
                        counter.style.color = '#ed8936';
                    } else {
                        counter.style.color = '#48bb78';
                    }
                }
                
                textarea.addEventListener('input', updateCounter);
                updateCounter();
            }

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const menu = document.getElementById('navMenu');
                const toggle = document.querySelector('.menu-toggle');
                const navbar = document.querySelector('.navbar');
                
                if (!navbar.contains(event.target)) {
                    menu.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>