<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'content',
        'status',
        'meta_title',
        'meta_desc',
        'thumbnail',
        'views',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category_map', 'article_id', 'category_id');
    }
}
