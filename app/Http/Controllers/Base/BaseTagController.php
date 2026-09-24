<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Helpers\ControllerHelpers;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BaseTagController
{
    public function getAllTags(bool $withCount = false): Collection {
        return Tag::query()
            ->when($withCount, function ($query) {
                $query->withCount('articles');
            })->orderBy('name', 'asc')->get();
    }

    public function getTagBySlug(string $slug): Tag {
        return Tag::where('slug', $slug)->firstOrFail();
    }

    public function createTag(array $data): Tag {
        $data['slug'] = ControllerHelpers::uniqueSlug($data['name'], Tag::class);
        return Tag::create($data);
    }

    public function updateTag(Tag $tag, array $data): Tag {
        if (isset($data['name']) && $data['name'] !== $tag->name) {
            $data['slug'] = ControllerHelpers::uniqueSlug($data['name'], Tag::class);
        }
        $tag->update($data);
        return $tag;
    }

    public function deleteTag(Tag $tag): bool {
        return (bool) $tag->delete();
    }
}
