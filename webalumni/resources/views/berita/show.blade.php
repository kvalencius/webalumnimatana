@extends('layout.layout_public')

@section('isiWebsite')
<!-- Breadcrumb & Title -->
<div class="breadcrumb-section" style="background-color: #1e3a5f; color: white; padding: 30px 0;">
    <div class="container">
        <small style="color: #ff9a56;">
            <a href="/" style="color: white; text-decoration: none;">Home</a> | <a href="/berita" style="color: white; text-decoration: none;">Berita</a> | <span style="color: #ff9a56;">{{ Str::limit($post->title, 40) }}</span>
        </small>
        <h1 style="font-size: 2.5rem; font-weight: bold; margin: 10px 0 0 0;">{{ $post->title }}</h1>
    </div>
</div>

<!-- Article Content -->
<div style="background-color: #f8f9fa; padding: 60px 0; min-height: calc(100vh - 300px);">
    <div class="container">
        <div class="row">
            <!-- Main Article -->
            <div class="col-lg-8">
                <article class="card shadow-sm" style="border: none; border-radius: 10px; overflow: hidden;">
                    <!-- Featured Image -->
                    @if($post->image)
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 400px; object-fit: cover;">
                    @else
                    <div style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                        {{ $post->category ?? 'Berita' }}
                    </div>
                    @endif

                    <div class="card-body p-4">
                        <!-- Category & Meta -->
                        <div class="mb-3">
                            @if($post->category)
                            <span class="badge bg-primary me-2">{{ $post->category }}</span>
                            @endif
                            <small class="text-muted">
                                <i class="fas fa-user"></i> {{ $post->user->name ?? 'Admin' }}
                                | <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                                | <i class="fas fa-eye"></i> {{ $post->likes_count ?? 0 }} Views
                            </small>
                        </div>

                        <!-- Title -->
                        <h1 style="color: #1e3a5f; margin-bottom: 20px; line-height: 1.4;">
                            {{ $post->title }}
                        </h1>

                        <!-- Divider -->
                        <hr style="margin: 20px 0;">

                        <!-- Article Content -->
                        <div class="article-content" style="line-height: 1.8; color: #333; font-size: 1.05rem;">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        <!-- Share Buttons (Optional) -->
                        <div class="mt-5 pt-4 border-top">
                            <p class="mb-2" style="color: #666; font-weight: 500;">Bagikan Artikel Ini:</p>
                            <div class="d-flex gap-2">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ url('/berita/' . $post->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/berita/' . $post->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('/berita/' . $post->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Posts -->
                @if($relatedPosts->count())
                <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
                    <div class="card-header" style="background-color: #1e3a5f; color: white; border-radius: 10px 10px 0 0;">
                        <h6 class="mb-0" style="font-weight: bold;">
                            <i class="fas fa-link"></i> Berita Terkait
                        </h6>
                    </div>
                    <div class="card-body">
                        @foreach($relatedPosts as $related)
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                            <h6 style="margin-bottom: 0.5rem;">
                                <a href="/berita/{{ $related->id }}" style="color: #1e3a5f; text-decoration: none; font-size: 0.95rem;">
                                    {{ Str::limit($related->title, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $related->created_at->format('d M Y') }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Back to Berita -->
                <a href="/berita" class="btn btn-outline-primary w-100" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Berita
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="card" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <!-- Featured Image -->
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" 
                         style="width: 100%; height: 400px; object-fit: cover;">
                    @else
                    <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    @endif

                    <div class="card-body" style="padding: 40px;">
                        <!-- Category Badge -->
                        @if($post->category)
                        <div class="mb-3">
                            <span class="badge" style="background-color: #5b7ec2; border-radius: 20px; padding: 8px 16px; font-size: 0.9rem;">
                                {{ $post->category }}
                            </span>
                        </div>
                        @endif

                        <!-- Title -->
                        <h1 style="color: #1a3d5c; font-weight: bold; margin-bottom: 15px; line-height: 1.4;">
                            {{ $post->title }}
                        </h1>

                        <!-- Meta Info -->
                        <div style="display: flex; align-items: center; gap: 20px; padding-bottom: 20px; border-bottom: 2px solid #eee; margin-bottom: 30px; color: #666; font-size: 0.95rem;">
                            <span>
                                <i class="fas fa-calendar"></i> 
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                            @if($post->user)
                            <span>
                                <i class="fas fa-user"></i> 
                                {{ $post->user->name }}
                            </span>
                            @endif
                            <span>
                                <i class="fas fa-eye"></i>
                                2.5K views
                            </span>
                        </div>

                        <!-- Content -->
                        <div style="color: #333; font-size: 1.05rem; line-height: 1.8; margin-bottom: 30px;">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        <!-- Share Buttons (Optional) -->
                        <div style="padding-top: 20px; border-top: 2px solid #eee; margin-top: 30px;">
                            <p style="margin-bottom: 15px; color: #666; font-weight: 500;">Bagikan artikel ini:</p>
                            <div style="display: flex; gap: 10px;">
                                <a href="#" class="btn btn-sm btn-primary" style="background-color: #5b7ec2; border: none; border-radius: 8px; padding: 10px 16px;">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                                <a href="#" class="btn btn-sm btn-info" style="background-color: #1da1f2; border: none; border-radius: 8px; padding: 10px 16px;">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="#" class="btn btn-sm btn-success" style="background-color: #25d366; border: none; border-radius: 8px; padding: 10px 16px;">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Back Button -->
                <div class="mt-4">
                    <a href="{{ route('berita') }}" class="btn btn-outline-primary" style="border-color: #5b7ec2; color: #5b7ec2;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Berita
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="card" style="border: none; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; color: #1a3d5c; margin-bottom: 20px;">Berita Terkait</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($relatedPosts as $item)
                            <div style="padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                <a href="{{ route('berita.show', $item->id) }}" style="text-decoration: none;">
                                    <div style="display: flex; gap: 10px;">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" 
                                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px;"></div>
                                        @endif
                                        <div style="flex-grow: 1;">
                                            <p style="font-weight: 500; color: #1a3d5c; margin: 0 0 8px 0; font-size: 0.95rem; line-height: 1.3;">
                                                {{ $item->title }}
                                            </p>
                                            <small style="color: #999;">
                                                {{ $item->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Newsletter Signup (Optional) -->
                <div class="card" style="border: none; border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; margin-bottom: 15px;">Langgani Berita</h5>
                        <p style="margin-bottom: 15px; font-size: 0.95rem;">Dapatkan update berita terbaru langsung ke email Anda.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email Anda" style="border-radius: 8px; border: none; padding: 10px 15px;">
                            </div>
                            <button type="submit" class="btn btn-light w-100" style="border-radius: 8px; font-weight: 500;">Langgani</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
