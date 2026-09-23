<?php

namespace App\Http\Controllers\Base;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseArticleController
{
    public function getPaginatedArticles(?string $category_slug = null, ?string $tag_slug = null, bool $onlyPublished = true, int $perPage = 10): LengthAwarePaginator {
        return Article::query()
            ->when($onlyPublished, function ($query) {
                $query->where('is_published', true);
            })
            ->when($category_slug, function ($query) use ($category_slug) {
                $query->whereHas('category', function ($q) use ($category_slug) {
                    $q->where('slug', $category_slug);
                });
            })
            ->when($tag_slug, function ($query) use ($tag_slug) {
                $query->whereHas('tags', function ($q) use ($tag_slug) {
                    $q->where('slug', $tag_slug);
                });
            })
            ->latest()->paginate($perPage);
    }

    public function getArticleBySlug(string $slug, bool $onlyPublished = true): Article {
        return Article::where('slug', $slug)
            ->when($onlyPublished, function ($query) {
                $query->where('is_published', true);
            })->firstOrFail();
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Article $article)
    {
        //
    }

    public function update(Request $request, Article $article)
    {
        //
    }

    public function destroy(Article $article)
    {
        //
    }
}
