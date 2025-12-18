<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'likes_count',
    ];

    /**
     * Relationship: Comment belongs to Post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relationship: Comment belongs to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all users who liked this comment
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')
                    ->withTimestamps();
    }
}
