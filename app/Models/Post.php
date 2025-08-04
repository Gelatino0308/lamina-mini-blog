<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'body',
        'image'
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
}
