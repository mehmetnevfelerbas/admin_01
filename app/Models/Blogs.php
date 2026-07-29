<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        'status',
        'image',
        'type',
        'likes_count',
        'dislikes_count',
    ];

    public function translate()
    {
        return $this->hasOne(BlogsTranslate::class, 'blog_id', 'id');
    }
}