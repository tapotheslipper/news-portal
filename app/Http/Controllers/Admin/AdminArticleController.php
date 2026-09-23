<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseArticleController;
use App\Http\Controllers\Base\BaseCategoryController;
use App\Http\Controllers\Base\BaseTagController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    protected BaseArticleController $common;
    protected BaseCategoryController $categories;
    protected BaseTagController $tags;

    public function __construct() {
        $this->common = new BaseArticleController();
        $this->categories = new BaseCategoryController();
        $this->tags = new BaseTagController();
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
        $tags = $this->tags->getAllTags();
        return view('pages.admin.articles.form', ['article' => new Article(), 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateArticle($request);
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);

        $this->common->createArticle($data, $request->file('image'), $tagIds, $request->user()->id);
        return redirect()->route('admin.articles.index')->with('status', 'Новость создана.');
    }

    public function edit(string $article_slug): View
    {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        $categories = $this->categories->getAllCategories();
        $tags = $this->tags->getAllTags();
        return view('pages.admin.articles.form', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, string $article_slug): RedirectResponse
    {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        $data = $this->validateArticle($request);
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);

        $this->common->updateArticle($article, $data, $request->file('image'), $tagIds);
        return redirect()->route('admin.articles.index')->with('status', 'Новость обновлена.');
    }

    public function destroy(string $article_slug): RedirectResponse
    {
        $article = $this->common->getArticleBySlug($article_slug, onlyPublished: false);
        $this->common->deleteArticle($article);
        return redirect()->route('admin.articles.index')->with('status', 'Новость удалена.');
    }

    protected function validateArticle(Request $request): array {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id']
        ]);
        $data['is_published'] = $request->boolean('is_published');
        return $data;
    }
}
