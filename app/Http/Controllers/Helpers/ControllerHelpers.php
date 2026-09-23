<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Str;

class ControllerHelpers {
    public static function uniqueSlug(string $title, string $modelClass, ?int $ignoreId = null): string {
        $fallback = strtolower(class_basename($modelClass));
        $base = Str::slug($title) ?: $fallback;
        $slug = $base;
        $i = 2;
        while (
            $modelClass::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()
        ) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}