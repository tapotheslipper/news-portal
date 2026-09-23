<?php

namespace App\Http\Controllers\Base;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use App\Http\Controllers\Helpers\ControllerHelpers;

class BaseCategoryController
{
    public function getAllCategories(bool $withCount = false): Collection {
        return Category::query()
            ->when($withCount, function ($query) {
                $query->withCount(['articles' => function ($q) {
                    $q->where('is_published', true);
                }]);
            })->orderBy('name', 'asc')->get();
    }

    public function getCategoryBySlug(string $slug): Category {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function createCategory(array $data): Category {
        $data['slug'] = ControllerHelpers::uniqueSlug($data['name'], Category::class);
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category {
        if (isset($data['name']) && $data['name'] !== $category->name) {
            $data['slug'] = ControllerHelpers::uniqueSlug($data['name'], Category::class, $category->id);
        }
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category): bool {
        return (bool) $category->delete();
    }
}
