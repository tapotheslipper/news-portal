<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = ['category_id', 'user_id', 'title', 'slug', 'content', 'image', 'is_published'];

    protected $with = ['category', 'tags'];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }
}
