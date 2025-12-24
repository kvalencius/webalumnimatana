@extends('layout.layout_public')

@section('isiWebsite')
<!-- Breadcrumb & Title -->
<div class="breadcrumb-section" style="background-color: #1e3a5f; color: white; padding: 10px 0; padding-left: 30px;">
    <div class="container" style="padding-left: 0;">
        <small style="color: #ff9a56;">
            <a href="/" style="color: white; text-decoration: none;">Home</a> | <span style="color: #ff9a56;">Berita</span>
        </small>
        <h1 style="font-size: 2.5rem; font-weight: bold; margin: 10px 0 0 0;">Berita</h1>
    </div>
</div>

<!-- Main Content -->
<div class="container mt-5 mb-5">
    <div class="row g-4" style="display: flex !important; flex-wrap: nowrap !important; width: 100%;">
        <!-- Posts Section -->
        <div style="flex: 0 0 66.666%; min-width: 0; padding-right: 16px;">

            <!-- Posts Grid -->
            @if($posts->count())
                @foreach($posts as $post)
                <article class="entry mb-5" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                    <!-- Entry Image -->
                    <div class="entry-img" style="height: 250px; overflow: hidden;">
                        @if($post->image)
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="object-fit: cover; width: 100%; height: 100%;">
                        @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                            {{ $post->category ?? 'Berita' }}
                        </div>
                        @endif
                    </div>

                    <!-- Entry Content -->
                    <div style="padding: 25px;">
                        <!-- Title -->
                        <h2 class="entry-title" style="margin-bottom: 15px;">
                            <a href="/berita/{{ $post->id }}" style="color: #1e3a5f; text-decoration: none; font-size: 1.4rem; font-weight: 600;">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <!-- Meta Info -->
                        <div class="entry-meta" style="margin-bottom: 15px; display: flex; gap: 20px; flex-wrap: wrap;">
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; gap: 15px;">
                                @if($post->category)
                                <li style="display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-tag" style="color: #4b8ef1;"></i>
                                    <a href="/berita?category={{ $post->category }}" style="color: #4b8ef1; text-decoration: none; font-size: 0.9rem;">
                                        {{ $post->category }}
                                    </a>
                                </li>
                                @endif
                                <li style="display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-calendar" style="color: #999;"></i>
                                    <time style="color: #999; font-size: 0.9rem;">{{ $post->created_at->format('Y-m-d') }}</time>
                                </li>
                                <li style="display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-eye" style="color: #999;"></i>
                                    <span style="color: #999; font-size: 0.9rem;">{{ $post->views_count ?? 0 }} Views</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Excerpt -->
                        <div class="entry-content" style="margin-bottom: 20px; color: #555; line-height: 1.6;">
                            {{ Str::limit(strip_tags($post->content), 200) }}
                        </div>

                        <!-- Read More Button -->
                        <div class="read-more">
                            <a href="/berita/{{ $post->id }}" class="btn btn-primary" style="background-color: #4b8ef1; color: white; border: none; padding: 8px 20px; border-radius: 5px; text-decoration: none;">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> Tidak ada berita yang ditemukan.
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div style="flex: 0 0 33.333%; min-width: 0;">
            <!-- Search Widget -->
            <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
                <div class="card-body p-4">
                    <h5 style="margin-bottom: 1rem; font-weight: bold; font-size: 1.1rem;">Search</h5>
                    <form action="/berita" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}" style="border-radius: 5px;">
                        <button type="submit" class="btn btn-primary" style="border-radius: 5px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Popular Posts with Thumbnails -->
            <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
                <div class="card-header" style="background-color: #1e3a5f; color: white; border-radius: 10px 10px 0 0;">
                    <h5 class="mb-0" style="font-weight: bold; font-size: 1rem;">
                        <i class="fas fa-fire"></i> Popular Posts
                    </h5>
                </div>
                <div class="card-body p-0">
                    @forelse($popularPosts as $popular)
                    <a href="/berita/{{ $popular->id }}" style="text-decoration: none; color: inherit; display: block; padding: 20px; border-bottom: 1px solid #e8e8e8; transition: background 0.2s;" onmouseover="this.style.background='#f9f9f9'" onmouseout="this.style.background=''">
                        <div style="display: flex; gap: 16px;">
                            <!-- Thumbnail -->
                            <div style="flex-shrink: 0; width: 85px; height: 85px;">
                                @if($popular->image)
                                <img src="{{ asset($popular->image) }}" alt="{{ $popular->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                                @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; text-align: center; padding: 5px; word-wrap: break-word;">
                                    {{ $popular->category ?? 'Berita' }}
                                </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div style="flex: 1; min-width: 0;">
                                <p style="margin: 0 0 10px 0; font-size: 0.95rem; color: #1e3a5f; font-weight: 600; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $popular->title }}
                                </p>
                                <small style="color: #aaa; display: block; margin-top: 0; font-size: 0.8rem;">
                                    <i class="fas fa-eye" style="font-size: 0.75rem;"></i> {{ $popular->views_count ?? 0 }} views
                                    | <i class="fas fa-calendar" style="font-size: 0.75rem;"></i> {{ $popular->created_at->format('d M y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div style="padding: 20px; text-align: center; color: #999;">
                        <p class="mb-0" style="font-size: 0.85rem;">Belum ada berita</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card shadow-sm" style="border: none; border-radius: 10px;">
                <div class="card-header" style="background-color: #1e3a5f; color: white; border-radius: 10px 10px 0 0;">
                    <h5 class="mb-0" style="font-weight: bold; font-size: 1.1rem;">
                        <i class="fas fa-list"></i> Kategori
                    </h5>
                </div>
                <div class="card-body" style="padding: 16px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <a href="/berita" class="badge" style="background-color: {{ !request('category') ? '#1e3a5f' : '#e9ecef' }}; color: {{ !request('category') ? 'white' : '#1e3a5f' }}; text-decoration: none; padding: 8px 12px; border-radius: 20px; cursor: pointer;">
                            Semua
                        </a>
                        @forelse($categories as $cat)
                        <a href="/berita?category={{ $cat }}" class="badge" style="background-color: {{ request('category') == $cat ? '#1e3a5f' : '#e9ecef' }}; color: {{ request('category') == $cat ? 'white' : '#1e3a5f' }}; text-decoration: none; padding: 8px 12px; border-radius: 20px; cursor: pointer;">
                            {{ $cat }}
                        </a>
                        @empty
                        <p class="text-muted mb-0">Tidak ada kategori</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
