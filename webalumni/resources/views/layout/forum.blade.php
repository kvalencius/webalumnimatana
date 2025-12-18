<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Forum - Matana University Alumni</title>  

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        html, body {
            background: linear-gradient(135deg, #667eea 0%, #667eea 100%) !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        header {
            position: relative;
            z-index: 100;
        }

        .forum-container {
            background-color: transparent;
            min-height: calc(100vh - 200px);
            padding: 120px 0 100px 0;
            margin-top: 20px;
            flex: 1;
        }

        .feed-wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        .post-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 32px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .post-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .post-header {
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #e5e5e5;
        }

        .post-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .post-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            background: #e0e0e0;
        }

        .post-user-details h6 {
            margin: 0;
            font-weight: 600;
            color: #1c1e21;
            font-size: 15px;
        }

        .post-user-details small {
            color: #65676b;
            font-size: 13px;
        }

        .post-content {
            padding: 16px 20px;
        }

        .post-content p {
            margin: 0 0 12px 0;
            color: #1c1e21;
            font-size: 15px;
            line-height: 1.5;
            word-wrap: break-word;
        }

        .post-media {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            background: #f0f0f0;
            margin-top: 12px;
            border-radius: 8px;
        }

        .post-video {
            width: 100%;
            max-height: 500px;
            margin-top: 12px;
            border-radius: 8px;
        }

        .post-stats {
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #65676b;
            border-bottom: 1px solid #e5e5e5;
        }

        .post-actions {
            padding: 8px 20px;
            display: flex;
            gap: 0;
            flex-wrap: wrap;
        }

        .post-action-btn {
            flex: 1;
            padding: 8px;
            border: none;
            background: none;
            color: #65676b;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .post-action-btn:hover {
            background-color: #f0f2f5;
        }

        .post-action-btn.liked {
            color: #e7165b;
        }

        .comments-section {
            background-color: #f8f9fa;
            padding: 16px 20px;
            border-top: 1px solid #e5e5e5;
        }

        .comment-item {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            background: #e0e0e0;
        }

        .comment-box {
            flex: 1;
            background-color: #f0f2f5;
            border-radius: 18px;
            padding: 8px 12px;
        }

        .comment-author {
            font-weight: 600;
            color: #1c1e21;
            font-size: 13px;
        }

        .comment-text {
            color: #1c1e21;
            font-size: 13px;
            margin: 2px 0 0 0;
        }

        .comment-time {
            font-size: 12px;
            color: #65676b;
            margin-top: 4px;
        }

        .comment-input-area {
            display: flex;
            gap: 8px;
            align-items: flex-end;
            padding-top: 12px;
        }

        .comment-input-area input {
            flex: 1;
            border: none;
            background-color: #f0f2f5;
            padding: 10px 16px;
            border-radius: 18px;
            font-size: 14px;
            outline: none;
            transition: background-color 0.2s;
        }

        .comment-input-area input:focus {
            background-color: #e4e6eb;
        }

        .comment-input-area button {
            background: none;
            border: none;
            color: #0a66c2;
            cursor: pointer;
            font-size: 20px;
        }

        .create-post-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 32px;
        }

        .create-post-input {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .create-post-input input {
            flex: 1;
            border: 1px solid #e5e5e5;
            padding: 12px 16px;
            border-radius: 24px;
            font-size: 14px;
            background-color: #f0f2f5;
            outline: none;
        }

        .create-post-input input:focus {
            background-color: white;
            border-color: #ccc;
        }

        .create-post-buttons {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e5e5;
        }

        .create-post-btn {
            flex: 1;
            padding: 10px;
            border: none;
            background-color: #f0f2f5;
            border-radius: 6px;
            color: #65676b;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .create-post-btn:hover {
            background-color: #e4e6eb;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px 20px;
            color: white;
        }

        .loading-spinner .spinner-border {
            color: white;
        }

        .no-posts {
            background: white;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            color: #65676b;
        }

        .no-posts i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 16px;
            display: block;
        }

        .pagination {
            justify-content: center;
            margin-top: 24px;
        }

        .pagination .page-link {
            background-color: white;
            border-color: #e5e5e5;
            color: #0a66c2;
        }

        .pagination .page-item.active .page-link {
            background-color: #0a66c2;
            border-color: #0a66c2;
        }

        .post-more-menu {
            background: none;
            border: none;
            cursor: pointer;
            color: #65676b;
            font-size: 20px;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .post-more-menu:hover {
            background-color: #f0f2f5;
        }

        .dropdown-menu {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background-color: #f0f2f5;
        }

        @media (max-width: 576px) {
            .feed-wrapper {
                padding: 0 12px;
            }

            .post-card {
                border-radius: 8px;
            }
        }
    </style>

    <!-- Blade Variables for Vue -->
    <script>
        window.currentUserId = {{ auth()->id() ?? 'null' }};
        window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        window.authUser = {
            name: @json(auth()->user()?->name ?? ''),
            email: @json(auth()->user()?->email ?? ''),
            role: @json(auth()->user()?->role ?? ''),
            profile_picture: @json(auth()->user()?->profile_picture ?? '')
        };
        window.routeLogin = @json(route('login'));
        window.routeDaftar = @json(route('daftar'));
    </script>
  </head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

<header>
    @include('layout.header')
</header>

<div id="forum-app" class="forum-container">
@verbatim
    <div class="feed-wrapper" style="max-width: 800px;">
        <!-- Create Post Card (Inline Form) -->
        <div class="create-post-card" style="padding: 0;">
            <!-- User Info Bar -->
            <div style="padding: 20px; display: flex; gap: 12px; align-items: center; border-bottom: 1px solid #e5e5e5;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; display: flex; align-items: center; justify-content: center; color: #999; flex-shrink: 0;">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h6 style="margin: 0; font-weight: 600; color: #1c1e21; font-size: 14px;">Posting Anonim</h6>
                    <small style="color: #65676b; font-size: 12px;">Publik</small>
                </div>
            </div>

            <!-- Textarea -->
            <div style="padding: 20px;">
                <textarea 
                    class="form-control" 
                    placeholder="Apa yang ingin Anda bagikan?"
                    v-model="newPost.content"
                    rows="4"
                    style="border: 1px solid #e5e5e5; border-radius: 8px; padding: 12px; font-size: 15px; resize: none; font-family: inherit; margin-bottom: 16px;"
                ></textarea>

                <!-- Image Preview -->
                <div v-if="imagePreview" style="position: relative; margin-bottom: 16px;">
                    <img :src="imagePreview" style="width: 100%; border-radius: 8px; max-height: 300px; object-fit: cover;">
                    <button 
                        type="button" 
                        class="btn btn-light" 
                        @click="removeImage"
                        style="position: absolute; top: 8px; right: 8px; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 0; border: none;"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Video Preview -->
                <div v-if="videoPreview" style="position: relative; margin-bottom: 16px;">
                    <video :src="videoPreview" controls style="width: 100%; border-radius: 8px; max-height: 300px;"></video>
                    <button 
                        type="button" 
                        class="btn btn-light" 
                        @click="removeVideo"
                        style="position: absolute; top: 8px; right: 8px; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 0; border: none;"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Upload Options (Icons) -->
                <div style="display: flex; gap: 12px; margin-bottom: 16px; position: relative;">
                    <label style="cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #31a24c; font-size: 20px; transition: background-color 0.2s; border-radius: 50%;" title="Tambahkan Gambar" :style="{ backgroundColor: imagePreview ? '#e8f5e9' : '#f0f2f5' }">
                        <i class="fas fa-images"></i>
                        <input type="file" @change="onImageSelected" accept="image/*" style="display: none;">
                    </label>
                    <label style="cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #e7165b; font-size: 20px; transition: background-color 0.2s; border-radius: 50%;" title="Tambahkan Video" :style="{ backgroundColor: videoPreview ? '#fce4ec' : '#f0f2f5' }">
                        <i class="fas fa-video"></i>
                        <input type="file" @change="onVideoSelected" accept="video/*" style="display: none;">
                    </label>
                    <button @click="toggleEmojiPicker" style="cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #f0ad4e; font-size: 20px; background-color: #f0f2f5; border: none; transition: background-color 0.2s; border-radius: 50%;" :style="{ backgroundColor: showEmojiPicker ? '#fff3e0' : '#f0f2f5' }" title="Tambahkan Emoji">
                        <i class="fas fa-smile"></i>
                    </button>
                    
                    <!-- Emoji Picker -->
                    <div v-if="showEmojiPicker" style="position: absolute; bottom: 50px; left: 0; background: white; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.2); padding: 12px; z-index: 1000; width: 300px;">
                        <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px; max-height: 250px; overflow-y: auto;">
                            <button 
                                v-for="emoji in emojis" 
                                :key="emoji" 
                                @click="insertEmoji(emoji)"
                                style="width: 40px; height: 40px; font-size: 24px; border: none; background: none; cursor: pointer; border-radius: 4px; transition: background-color 0.2s; display: flex; align-items: center; justify-content: center;"
                                @mouseover="$event.target.style.backgroundColor = '#f0f2f5'"
                                @mouseout="$event.target.style.backgroundColor = 'transparent'"
                            >
                                {{ emoji }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Post Button -->
                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                    <button 
                        type="button" 
                        class="btn"
                        @click="clearForm"
                        style="color: #0a66c2; background-color: transparent; border: 1px solid #e5e5e5; font-weight: 600; padding: 10px 20px; border-radius: 6px; cursor: pointer;"
                        v-if="newPost.content || newPost.image || newPost.video"
                    >
                        Bersihkan
                    </button>
                    <button 
                        type="button" 
                        class="btn"
                        style="background-color: #0a66c2; color: white; font-weight: 600; padding: 10px 28px; border-radius: 6px; border: none; transition: background-color 0.2s;"
                        @click="createPost"
                        :disabled="(!newPost.content && !newPost.image && !newPost.video) || loadingCreatePost"
                        :style="{ opacity: ((!newPost.content && !newPost.image && !newPost.video) || loadingCreatePost) ? '0.5' : '1', cursor: ((!newPost.content && !newPost.image && !newPost.video) || loadingCreatePost) ? 'not-allowed' : 'pointer' }"
                    >
                        <span v-if="loadingCreatePost" class="spinner-border spinner-border-sm me-2" style="width: 14px; height: 14px; border-width: 2px;"></span>
                        {{ loadingCreatePost ? 'Memposting...' : 'Posting' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Memuat posting...</p>
        </div>

        <!-- Posts List -->
        <div v-else-if="posts.length > 0">
            <div v-for="post in posts" :key="post.id" class="post-card">
                <!-- Post Header -->
                <div class="post-header">
                    <div class="post-user-info">
                        <div v-if="post.user_id === 2" style="width: 48px; height: 48px; border-radius: 50%; background: #e0e0e0; display: flex; align-items: center; justify-content: center; color: #999; flex-shrink: 0;">
                            <i class="fas fa-user" style="font-size: 20px;"></i>
                        </div>
                        <img 
                            v-else
                            :src="post.user.profile_picture || 'https://via.placeholder.com/48'" 
                            class="post-avatar"
                            onerror="this.src='https://via.placeholder.com/48'"
                        >
                        <div class="post-user-details">
                            <h6>{{ post.user_id === 2 ? 'Posting Anonim' : post.user.name }}</h6>
                            <small>{{ formatDate(post.created_at) }}</small>
                        </div>
                    </div>
                    <div class="dropdown" style="position: relative; display: inline-block;">
                        <button class="post-more-menu" type="button" @click="toggleDropdown(post.id)" style="background: none; border: none; cursor: pointer; color: #65676b; font-size: 20px; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background-color 0.2s;">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul :style="{ display: activeDropdown === post.id ? 'block' : 'none' }" class="dropdown-menu" style="position: absolute; right: 0; top: 100%; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); min-width: 150px; z-index: 100; margin: 8px 0 0 0; padding: 0; list-style: none;">
                            <li>
                                <a class="dropdown-item" href="#" @click.prevent="editPost(post)" style="display: block; padding: 8px 16px; color: #0a66c2; text-decoration: none; border-bottom: 1px solid #e5e5e5; cursor: pointer;">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" @click.prevent="deletePost(post.id)" style="display: block; padding: 8px 16px; color: #dc2626; text-decoration: none; cursor: pointer;">
                                    <i class="fas fa-trash me-2"></i>Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="post-content">
                    <p v-if="post.content">{{ post.content }}</p>

                    <!-- Post Image -->
                    <img v-if="post.image" :src="`/storage/${post.image}`" class="post-media" onerror="this.src='https://via.placeholder.com/400x300'">

                    <!-- Post Video -->
                    <video v-if="post.video" class="post-video" controls>
                        <source :src="`/storage/${post.video}`" type="video/mp4">
                        Browser Anda tidak mendukung video HTML5.
                    </video>
                </div>

                <!-- Post Stats -->
                <div class="post-stats">
                    <span v-if="post.likes_count > 0">
                        <i class="fas fa-thumbs-up" style="color: #0a66c2;"></i> {{ post.likes_count }}
                    </span>
                    <span v-if="post.comments_count > 0">
                        {{ post.comments_count }} komentar
                    </span>
                </div>

                <!-- Post Actions -->
                <div class="post-actions">
                    <button 
                        class="post-action-btn"
                        :class="{ 'liked': isPostLiked(post.id) }"
                        @click="togglePostLike(post)"
                    >
                        <i class="fas fa-thumbs-up"></i> {{ isPostLiked(post.id) ? 'Unlike' : 'Like' }}
                    </button>
                    <button 
                        class="post-action-btn"
                        @click="toggleCommentForm(post.id)"
                    >
                        <i class="fas fa-comment"></i> Komentar
                    </button>
                    <button class="post-action-btn">
                        <i class="fas fa-share"></i> Bagikan
                    </button>
                </div>

                <!-- Comments Section -->
                <div v-if="post.comments && post.comments.length > 0" class="comments-section">
                    <div v-for="comment in post.comments" :key="comment.id" class="comment-item">
                        <img 
                            :src="comment.user.profile_picture || 'https://via.placeholder.com/32'" 
                            class="comment-avatar"
                            onerror="this.src='https://via.placeholder.com/32'"
                        >
                        <div style="flex: 1;">
                            <div class="comment-box">
                                <div class="comment-author">{{ comment.user.name }}</div>
                                <p class="comment-text">{{ comment.content }}</p>
                            </div>
                            <div style="display: flex; gap: 12px; margin-top: 4px; font-size: 12px;">
                                <span class="comment-time">{{ formatDate(comment.created_at) }}</span>
                                <button 
                                    v-if="isLoggedIn"
                                    class="btn btn-link btn-sm"
                                    :class="{ 'text-danger': isCommentLiked(comment.id) }"
                                    @click="toggleCommentLike(comment)"
                                    style="padding: 0; text-decoration: none; color: #65676b;"
                                >
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                                <button 
                                    v-if="isCommentOwner(comment) || isPostOwnerByComment(comment)"
                                    class="btn btn-link btn-sm text-danger"
                                    @click="deleteComment(comment.id)"
                                    style="padding: 0; text-decoration: none;"
                                >
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Input -->
                    <div v-if="showCommentForm[post.id]" class="comment-input-area">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #e0e0e0; display: flex; align-items: center; justify-content: center; color: #999; flex-shrink: 0;">
                            <i class="fas fa-user" style="font-size: 14px;"></i>
                        </div>
                        <input 
                            type="text"
                            placeholder="Tulis komentar..."
                            v-model="newComments[post.id]"
                            @keyup.enter="addComment(post.id)"
                        >
                        <button @click="addComment(post.id)" :disabled="!newComments[post.id]">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- No Posts Message -->
        <div v-else class="no-posts">
            <i class="fas fa-inbox"></i>
            <p><strong>Belum ada posting</strong></p>
            <p style="font-size: 14px;">Jadilah yang pertama untuk berbagi cerita Anda!</p>
        </div>

        <!-- Pagination -->
        <nav v-if="lastPage > 1" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: !hasPreviousPage }">
                    <a class="page-link" href="#" @click.prevent="previousPage">← Sebelumnya</a>
                </li>
                <li class="page-item">
                    <span class="page-link" style="background: white; border: 1px solid #e5e5e5; color: #65676b;">
                        Halaman {{ currentPage }} dari {{ lastPage }}
                    </span>
                </li>
                <li class="page-item" :class="{ disabled: !hasNextPage }">
                    <a class="page-link" href="#" @click.prevent="nextPage">Berikutnya →</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endverbatim

@include('layout.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    const { createApp } = Vue;

    const app = {
        data() {
            return {
                posts: [],
                newPost: {
                    content: '',
                    image: null,
                    video: null,
                },
                imagePreview: null,
                videoPreview: null,
                newComments: {},
                showCommentForm: {},
                loadingCreatePost: false,
                loadingComment: {},
                loading: true,
                currentPage: 1,
                lastPage: 1,
                likedPosts: new Set(),
                likedComments: new Set(),
                isLoggedIn: window.isLoggedIn,
                currentUserId: window.currentUserId,
                authUser: window.authUser,
                routeLogin: window.routeLogin,
                routeDaftar: window.routeDaftar,
                showCreatePostModal: false,
                showEmojiPicker: false,
                activeDropdown: null,
                emojis: [
                    '😀', '😁', '😂', '🤣', '😃', '😄', '😅', '😆', '😉', '😊',
                    '😋', '😎', '😍', '🥰', '😘', '😗', '😙', '😚', '🙂', '🤗',
                    '🤩', '🤔', '🤨', '😐', '😑', '😶', '🙄', '😏', '😣', '😥',
                    '😮', '🤐', '😯', '😪', '😫', '🥱', '😴', '😌', '😛', '😜',
                    '😝', '🤤', '😒', '😓', '😔', '😕', '🙃', '🤑', '😲', '☹️',
                    '🙁', '😖', '😞', '😟', '😤', '😢', '😭', '😦', '😧', '😨',
                    '😩', '🤯', '😬', '😰', '😱', '🥵', '🥶', '😳', '🤪', '😵',
                    '🥴', '😠', '😡', '🤬', '😷', '🤒', '🤕', '🤢', '🤮', '🤧',
                    '👍', '👎', '👏', '🙌', '👋', '✌️', '🤞', '🤟', '🤘', '👌',
                    '❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '💔', '💕', '💖',
                    '🔥', '✨', '🎉', '🎊', '💯', '⭐', '🌟', '💫', '🏆', '🎁'
                ],
            };
        },
        mounted() {
            this.fetchPosts();
            window.addEventListener('resize', () => this.adjustPadding());
            // Close dropdown saat diklik di luar
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown')) {
                    this.activeDropdown = null;
                }
            });
        },
        methods: {
            toggleDropdown(postId) {
                this.activeDropdown = this.activeDropdown === postId ? null : postId;
            },
            fetchPosts() {
                this.loading = true;
                axios.get('/api/posts?page=' + this.currentPage)
                    .then(response => {
                        this.posts = response.data.data.data;
                        this.currentPage = response.data.data.current_page;
                        this.lastPage = response.data.data.last_page;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching posts:', error);
                        this.loading = false;
                    });
            },
            createPost() {
                if (!this.newPost.content && !this.newPost.image && !this.newPost.video) {
                    alert('Mohon tulis konten atau pilih gambar/video');
                    return;
                }

                this.loadingCreatePost = true;
                const formData = new FormData();
                formData.append('content', this.newPost.content);
                if (this.newPost.image) {
                    formData.append('image', this.newPost.image);
                }
                if (this.newPost.video) {
                    formData.append('video', this.newPost.video);
                }

                axios.post('/api/posts', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                })
                .then(response => {
                    this.posts.unshift(response.data.data);
                    this.newPost = { content: '', image: null, video: null };
                    this.imagePreview = null;
                    this.videoPreview = null;
                    this.showCreatePostModal = false;
                    this.showEmojiPicker = false;
                    
                    // Close modal if exists
                    const modal = document.getElementById('createPostModal');
                    if (modal) {
                        const bsModal = bootstrap.Modal.getInstance(modal);
                        if (bsModal) bsModal.hide();
                    }
                    
                    alert('Posting berhasil dibuat!');
                })
                .catch(error => {
                    console.error('Error creating post:', error);
                    alert('Gagal membuat posting: ' + (error.response?.data?.message || 'Kesalahan server'));
                })
                .finally(() => {
                    this.loadingCreatePost = false;
                });
            },
            onImageSelected(event) {
                const file = event.target.files[0];
                if (file) {
                    // Hapus video jika ada (hanya boleh salah satu)
                    this.newPost.video = null;
                    this.videoPreview = null;
                    
                    this.newPost.image = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            onVideoSelected(event) {
                const file = event.target.files[0];
                if (file) {
                    // Hapus gambar jika ada (hanya boleh salah satu)
                    this.newPost.image = null;
                    this.imagePreview = null;
                    
                    this.newPost.video = file;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.videoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            removeImage() {
                this.newPost.image = null;
                this.imagePreview = null;
            },
            removeVideo() {
                this.newPost.video = null;
                this.videoPreview = null;
            },
            toggleEmojiPicker() {
                this.showEmojiPicker = !this.showEmojiPicker;
            },
            insertEmoji(emoji) {
                this.newPost.content += emoji;
                this.showEmojiPicker = false;
            },
            closeModal() {
                this.showCreatePostModal = false;
                this.showEmojiPicker = false;
            },
            clearForm() {
                this.newPost = { content: '', image: null, video: null };
                this.imagePreview = null;
                this.videoPreview = null;
                this.showEmojiPicker = false;
            },
            toggleCommentForm(postId) {
                this.showCommentForm[postId] = !this.showCommentForm[postId];
            },
            addComment(postId) {
                const content = this.newComments[postId];
                if (!content) return;

                this.loadingComment[postId] = true;
                axios.post(`/api/posts/${postId}/comments`, { content })
                .then(response => {
                    const post = this.posts.find(p => p.id === postId);
                    if (post) {
                        if (!post.comments) post.comments = [];
                        post.comments.push(response.data.data);
                        post.comments_count++;
                    }
                    this.newComments[postId] = '';
                    this.showCommentForm[postId] = false;
                })
                .catch(error => {
                    console.error('Error adding comment:', error);
                    alert('Gagal menambahkan komentar');
                })
                .finally(() => {
                    this.loadingComment[postId] = false;
                });
            },
            deleteComment(commentId) {
                if (confirm('Yakin ingin menghapus komentar ini?')) {
                    axios.delete(`/api/comments/${commentId}`)
                    .then(() => {
                        this.fetchPosts();
                        alert('Komentar berhasil dihapus');
                    })
                    .catch(error => {
                        console.error('Error deleting comment:', error);
                        alert('Gagal menghapus komentar');
                    });
                }
            },
            editComment(comment) {
                const newContent = prompt('Edit komentar:', comment.content);
                if (newContent && newContent !== comment.content) {
                    axios.put(`/api/comments/${comment.id}`, { content: newContent })
                    .then(() => {
                        this.fetchPosts();
                        alert('Komentar berhasil diperbarui');
                    })
                    .catch(error => {
                        console.error('Error updating comment:', error);
                        alert('Gagal memperbarui komentar');
                    });
                }
            },
            editPost(post) {
                const newContent = prompt('Edit posting:', post.content);
                if (newContent && newContent !== post.content) {
                    axios.put(`/api/posts/${post.id}`, { content: newContent })
                    .then(() => {
                        this.fetchPosts();
                        alert('Posting berhasil diperbarui');
                    })
                    .catch(error => {
                        console.error('Error updating post:', error);
                        alert('Gagal memperbarui posting');
                    });
                }
            },
            deletePost(postId) {
                if (confirm('Yakin ingin menghapus posting ini?')) {
                    axios.delete(`/api/posts/${postId}`)
                    .then(() => {
                        this.fetchPosts();
                        alert('Posting berhasil dihapus');
                    })
                    .catch(error => {
                        console.error('Error deleting post:', error);
                        alert('Gagal menghapus posting');
                    });
                }
            },
            togglePostLike(post) {
                axios.post(`/api/posts/${post.id}/like`)
                .then(response => {
                    post.likes_count = response.data.likes_count;
                    if (response.data.liked) {
                        this.likedPosts.add(post.id);
                    } else {
                        this.likedPosts.delete(post.id);
                    }
                })
                .catch(error => {
                    console.error('Error liking post:', error);
                    if (error.response?.status === 401) {
                        alert('Silakan login terlebih dahulu');
                    } else {
                        alert('Gagal like posting');
                    }
                });
            },
            toggleCommentLike(comment) {
                axios.post(`/api/comments/${comment.id}/like`)
                .then(response => {
                    comment.likes_count = response.data.likes_count;
                    if (response.data.liked) {
                        this.likedComments.add(comment.id);
                    } else {
                        this.likedComments.delete(comment.id);
                    }
                })
                .catch(error => {
                    console.error('Error liking comment:', error);
                    alert('Gagal like komentar');
                });
            },
            isPostLiked(postId) {
                return this.likedPosts.has(postId);
            },
            isCommentLiked(commentId) {
                return this.likedComments.has(commentId);
            },
            isPostOwner(post) {
                return this.currentUserId === post.user_id;
            },
            isCommentOwner(comment) {
                return this.currentUserId === comment.user_id;
            },
            isPostOwnerByComment(comment) {
                const post = this.posts.find(p => p.id === comment.post_id);
                return post && this.currentUserId === post.user_id;
            },
            formatDate(date) {
                return new Date(date).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },
            nextPage() {
                if (this.currentPage < this.lastPage) {
                    this.currentPage++;
                    this.fetchPosts();
                }
            },
            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchPosts();
                }
            },
            adjustPadding() {
                const forumContainer = document.querySelector('.forum-container');
                if (forumContainer) {
                    const contentHeight = forumContainer.scrollHeight;
                    const minHeight = window.innerHeight - 200;
                    
                    if (contentHeight < minHeight) {
                        forumContainer.style.minHeight = minHeight + 'px';
                    } else {
                        forumContainer.style.minHeight = 'auto';
                        forumContainer.style.paddingBottom = (contentHeight * 0.1) + 'px';
                    }
                }
            },
            get hasNextPage() {
                return this.currentPage < this.lastPage;
            },
            get hasPreviousPage() {
                return this.currentPage > 1;
            }
        },
        watch: {
            posts(newVal) {
                // Auto adjust padding ketika posts berubah
                this.$nextTick(() => {
                    this.adjustPadding();
                });
            }
        }
    };

    // Initialize Vue app
    createApp(app).mount('#forum-app');
</script>

</body>
</html>
