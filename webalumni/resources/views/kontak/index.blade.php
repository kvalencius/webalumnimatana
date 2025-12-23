@extends('layout.layout_public')

@section('isiWebsite')
<!-- Breadcrumb & Title -->
<div class="breadcrumb-section" style="background-color: #1e3a5f; color: white; padding: 30px 0;">
    <div class="container">
        <small style="color: #ff9a56;">
            <a href="/" style="color: white; text-decoration: none;">Home</a> | <span style="color: #ff9a56;">Kontak Kami</span>
        </small>
        <h1 style="font-size: 2.5rem; font-weight: bold; margin: 10px 0 0 0;">Kontak Kami</h1>
    </div>
</div>

<!-- Main Content -->
<div class="container mt-5 mb-5" style="text-align: center; padding: 60px 20px;">
    <h2 style="color: #1e3a5f; font-weight: bold; margin-bottom: 30px;">Hubungi Kami</h2>
    <p style="color: #666; margin-bottom: 40px; font-size: 1.1rem;">
        Silahkan hubungi kami melalui informasi yang tersedia di footer atau lewat social media kami.
    </p>
    
    <div style="max-width: 500px; margin: 0 auto;">
        <img src="{{ asset('assets/images/service.webp') }}" class="img-fluid" alt="Customer Service Illustration" style="width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    </div>
</div>
@endsection