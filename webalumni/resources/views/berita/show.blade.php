@extends('layout.layout_public')

@section('isiWebsite')
<!-- Breadcrumb & Title -->
<div class="breadcrumb-section" style="background-color: #1e3a5f; color: white; padding: 15px 0;">
    <div class="container">
        <small style="color: #ff9a56;">
            <a href="/" style="color: white; text-decoration: none;">Home</a> / 
            <a href="/berita" style="color: white; text-decoration: none;">Berita</a> / 
            <span style="color: #ff9a56;">{{ Str::limit($post->title, 50) }}</span>
        </small>
    </div>
</div>

<!-- Main Content -->
<div style="background-color: #f8f9fa; padding: 40px 0; min-height: calc(100vh - 200px);">
    <div class="container">
        <div class="row g-4" style="display: flex !important; flex-wrap: nowrap !important; width: 100%;">
            <!-- Main Article (70%) -->
            <div style="flex: 0 0 66.666%; min-width: 0; padding-right: 16px;">
                <!-- Featured Image -->
                <div style="margin-bottom: 30px; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    @if($post->image)
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; max-height: 450px; object-fit: cover;">
                    @else
                    <div style="width: 100%; height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                        {{ $post->category ?? 'Berita' }}
                    </div>
                    @endif
                </div>

                <!-- Article Card -->
                <article style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <!-- Category & Meta -->
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;">
                        @if($post->category)
                        <span style="background-color: #e8f0f8; color: #1e3a5f; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                            <i class="fas fa-tag"></i> {{ $post->category }}
                        </span>
                        @endif
                        <small style="color: #999;">
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                        </small>
                        <small style="color: #999;">
                            <i class="fas fa-eye"></i> {{ $post->views_count ?? 0 }} Views
                        </small>
                    </div>

                    <!-- Title -->
                    <h1 style="color: #1e3a5f; font-weight: 700; font-size: 2rem; margin-bottom: 20px; line-height: 1.4;">
                        {{ $post->title }}
                    </h1>

                    <!-- Divider -->
                    <hr style="margin: 25px 0; border: none; border-top: 1px solid #eee;">

                    <!-- Article Content -->
                    <div style="color: #333; font-size: 1.05rem; line-height: 1.8; margin-bottom: 30px;">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </article>
            </div>

            <!-- Sidebar (30%) -->
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
                        @forelse($relatedPosts->take(5) as $popular)
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
                        @php
                            $categories = App\Models\Post::distinct()->pluck('category')->filter();
                        @endphp
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
</div>
@endsection
