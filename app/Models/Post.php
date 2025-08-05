<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'body',
        'image',
        'likes'
    ];

    public static function getCategories() 
    {
        return [
            'shonen' => 'Shonen',
            'shojo' => 'Shojo',
            'seinen' => 'Seinen',
            'josei' => 'Josei',
            'kodomomuke' => 'Kodomomuke'
        ];
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user_likes')->withTimestamps();
    }

    public function isLikedBy($user) : bool
    {
        if (!$user) {
            return false;
        }

        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
