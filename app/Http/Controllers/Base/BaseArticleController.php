<?php

namespace App\Http\Controllers\Base;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Http\Controllers\Helpers\ControllerHelpers;

class BaseArticleController
{
    public function getPaginatedArticles(
        ?string $category_slug = null,
        ?string $tag_slug = null,
        ?string $search = null,
        bool $onlyPublished = true,
        int $perPage = 10
    ):LengthAwarePaginator {
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
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()->paginate($perPage);
    }

    public function getArticleBySlug(string $slug, bool $onlyPublished = true): Article {
        return Article::where('slug', $slug)
            ->when($onlyPublished, function ($query) {
                $query->where('is_published', true);
            })->firstOrFail();
    }

    public function createArticle(array $data, ?UploadedFile $image, array $tagIds, int $userId): Article {
        $data['slug'] = ControllerHelpers::uniqueSlug($data['title'], Article::class);
        $data['user_id'] = $userId;

        if ($image) {
            $data['image'] = $this->storeImage($image);
        }
        $article = Article::create($data);
        $article->tags()->sync($tagIds);
        return $article;
    }

    public function updateArticle(Article $article, array $data, ?UploadedFile $image, array $tagIds): Article {
        if (isset($data['title']) && $data['title'] !== $article->title) {
            $data['slug'] = ControllerHelpers::uniqueSlug($data['title'], Article::class, $article->id);
        }
        if ($image) {
            $data['image'] = $this->storeImage($image);
        }
        $article->update($data);
        $article->tags()->sync($tagIds);
        return $article;
    }

    public function deleteArticle(Article $article): bool {
        return (bool) $article->delete();
    }

    protected function storeImage(UploadedFile $image): string {
        return $image->storeAs(
            'articles',
            Str::uuid()->toString() . '.' . $image->extension(),
            'public'
        );
    }
}
