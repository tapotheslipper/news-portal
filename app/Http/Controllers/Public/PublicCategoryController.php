<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseCategoryController;
use Illuminate\View\View;

class PublicCategoryController extends Controller
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
        return view('pages.categories.index', compact('categories'));
    }
}
