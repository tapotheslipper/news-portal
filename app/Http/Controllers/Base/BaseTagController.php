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
            $data['slug'] = ControllerHelpers::uniqueSlug($data['name'], $tag->id);
        }
        $tag->update($data);
        return $tag;
    }

    public function deleteTag(Tag $tag): bool {
        return (bool) $tag->delete();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
