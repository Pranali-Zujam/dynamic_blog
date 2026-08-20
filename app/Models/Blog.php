<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'banner',
        'seo_title',
        'seo_description',
        'canonical_url',
        'schema_markup',
        'views',
        'status',
        'published_at',
    ];
    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
