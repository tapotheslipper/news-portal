<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseArticleController;
use App\Http\Controllers\Base\BaseCategoryController;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    protected BaseArticleController $common;
    protected BaseCategoryController $categories;

    public function __construct() {
        $this->common = new BaseArticleController();
        $this->categories = new BaseCategoryController();
    }

    public function index(Request $request): View {
        $category_slug = $request->query('category');
        $tag_slug = $request->query('tag');
        $articles = $this->common->getPaginatedArticles(
            category_slug: $category_slug,
            tag_slug: $tag_slug,
            onlyPublished: false,
            perPage: 25,
        );
        return view('pages.admin.articles.index', compact('articles', 'category_slug', 'tag_slug'));
    }

    public function show(string $article_slug): View {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        return view('pages.admin.articles.show', compact('article'));
    }

    public function create(): View
    {
        $categories = $this->categories->getAllCategories();
        return view('pages.admin.articles.form', ['article' => new Article(), 'categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateArticle($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAs(
                'articles',
                Str::uuid()->toString() . '.' . $request->file('image')->extension(),
                'public'
            );
        }

        $tagNames = $this->parseTags($request->input('tags'));
        unset($data['tags']);

        $article = Article::create($data);
        $this->syncTags($article, $tagNames);
        return redirect()->route('admin.articles.index')->with('status', 'Новость создана.');
    }

    public function edit(string $slug): View
    {
        $article = $this->common->getArticleBySlug($slug, onlyPublished: false);
        $categories = $this->categories->getAllCategories();
        return view('pages.admin.articles.form', compact('article', 'categories'));
    }

    public function update(Request $request, string $article_slug): RedirectResponse
    {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        $data = $this->validateArticle($request);

        if ($data['title'] !== $article->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $article->id);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAs(
                'articles',
                Str::uuid()->toString() . '.' . $request->file('image')->extension(),
                'public'
            );
        }

        $tagNames = $this->parseTags($request->input('tags'));
        unset($data['tags']);

        $article->update($data);
        $this->syncTags($article, $tagNames);
        return redirect()->route('admin.articles.index')->with('status', 'Новость обновлена.');
    }

    public function destroy(string $article_slug): RedirectResponse
    {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('status', 'Новость удалена.');
    }

    protected function validateArticle(Request $request): array {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
            'is_published' => ['nullable', 'boolean'],
            'tags' => ['nullable', 'string']
        ]) + ['is_published' => $request->boolean('is_published')];
    }

    protected function parseTags(?string $raw): array {
        if (!$raw) {
            return [];
        }
        return collect(explode(',', $raw))->map(fn ($t) => trim($t))->filter()->unique()->values()->all();
    }

    protected function syncTags(Article $article, array $tagNames): void {
        $ids = collect($tagNames)->map(function (string $name) {
            $slug = Str::slug($name) ?: Str::random(6);
            return Tag::firstOrCreate(['slug' => $slug], ['name' => $name])->id;
        });
        $article->tags()->sync($ids);
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string {
        $base = Str::slug($title) ?: 'article';
        $slug = $base;
        $i = 2;
        while (Article::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
