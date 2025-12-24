<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'content',
        'excerpt',
        'image',
        'video',
        'comments_count',
        'views_count',
    ];

    /**
     * Relationship: Post belongs to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Post has many Comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all users who liked this post
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id')
                    ->withTimestamps();
    }
}
