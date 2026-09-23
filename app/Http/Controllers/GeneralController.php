<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function home()
    {
        $latestArticles = Article::where('is_published', true)->latest()->take(5)->get();
        $popularCategories = Category::withCount(['articles' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('articles_count', 'desc')->take(10)->get();
        return view('pages.general.home', compact('latestArticles', 'popularCategories'));
    }
}
