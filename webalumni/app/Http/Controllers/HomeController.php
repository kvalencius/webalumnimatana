<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return view('layout.beranda');
    }

    public function tentang()
    {
        return view('tentang.index');
    }

    public function berita(Request $request)
    {
        $query = Post::with('user')->latest();
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }
        
        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(12);
        $categories = Post::distinct()->pluck('category')->filter();
        $popularPosts = Post::latest()->take(5)->get();
        
        return view('berita.index', compact('posts', 'categories', 'popularPosts'));
    }

    public function show_post($id)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($id);
        $relatedPosts = Post::where('category', $post->category)
                           ->where('id', '!=', $id)
                           ->take(3)
                           ->get();
        return view('berita.show', compact('post', 'relatedPosts'));
    }

    public function lowongan()
    {
        return view('lowongan.index');
    }

    public function events()
    {
        return view('events.index');
    }
}
