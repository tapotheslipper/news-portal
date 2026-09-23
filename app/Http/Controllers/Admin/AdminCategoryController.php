<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseCategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    protected BaseCategoryController $common;

    public function __construct() {
        $this->common = new BaseCategoryController();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = $this->common->getAllCategories(withCount: true);
        return view('pages.admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.categories.form', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $data['slug'] = $this->uniqueSlug($data['name']);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('status', 'Категория создана.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category_slug): View
    {
        $category = $this->common->getCategoryBySlug($category_slug);
        return view('pages.admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category_slug): RedirectResponse
    {
        $category = $this->common->getCategoryBySlug($category_slug);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($data['name'] !== $category->name) {
            $data['slug'] = $this->uniqueSlug($data['name'], $category->id);
        }
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('status', 'Категория обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_slug): RedirectResponse
    {
        $category = $this->common->getCategoryBySlug($category_slug);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Категория удалена.');
    }
}
