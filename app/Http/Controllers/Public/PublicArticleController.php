<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseArticleController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicArticleController extends Controller
{
    protected BaseArticleController $common;

    public function __construct() {
        $this->common = new BaseArticleController();
    }

    public function index(Request $request): View {
        $category_slug = $request->query('category');
        $tag_slug = $request->query('tag');
        $search = $request->query('search');
        $articles = $this->common->getPaginatedArticles(
            category_slug: $category_slug,
            tag_slug: $tag_slug,
            search: $search,
            onlyPublished: true,
            perPage: 10,
        )->appends($request->query());
        return view('pages.articles.index', compact('articles', 'category_slug', 'tag_slug', 'search'));
    }

    public function show(string $slug): View {
        $article = $this->common->getArticleBySlug($slug, onlyPublished: true);
        return view('pages.articles.show', compact('article'));
    }
}
