<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Get all comments for a post
     */
    public function index(string $postId)
    {
        $post = Post::findOrFail($postId);
        
        $comments = $post->comments()
                        ->with('user', 'likes')
                        ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }

    /**
     * Store a new comment on a post
     */
    public function store(Request $request, string $postId)
    {
        $post = Post::findOrFail($postId);

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = auth()->id() ?? 1;
        $comment->content = $validated['content'];
        $comment->save();

        // Update comments_count di post
        $post->increment('comments_count');

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dibuat',
            'data' => $comment->load('user'),
        ], 201);
    }

    /**
     * Display the specified comment
     */
    public function show(string $id)
    {
        $comment = Comment::with('user', 'post', 'likes')
                         ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $comment,
        ]);
    }

    /**
     * Update the specified comment
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        // Pastikan user adalah pemilik comment
        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah komentar ini',
            ], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $comment->content = $validated['content'];
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil diperbarui',
            'data' => $comment->load('user'),
        ]);
    }

    /**
     * Delete the specified comment
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        // Pastikan user adalah pemilik comment atau post owner
        if ($comment->user_id !== auth()->id() && $comment->post->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus komentar ini',
            ], 403);
        }

        $post = $comment->post;
        $comment->delete();

        // Update comments_count di post
        $post->decrement('comments_count');

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus',
        ]);
    }

    /**
     * Like/Unlike a comment
     */
    public function toggleLike(string $id)
    {
        $comment = Comment::findOrFail($id);
        $user = auth()->user();

        if ($user->likedComments()->where('comment_id', $id)->exists()) {
            // Unlike
            $user->likedComments()->detach($id);
            $comment->decrement('likes_count');
        } else {
            // Like
            $user->likedComments()->attach($id);
            $comment->increment('likes_count');
        }

        return response()->json([
            'success' => true,
            'message' => $user->likedComments()->where('comment_id', $id)->exists() ? 'Komentar di-like' : 'Like dihapus',
            'liked' => $user->likedComments()->where('comment_id', $id)->exists(),
            'likes_count' => $comment->fresh()->likes_count,
        ]);
    }
}
