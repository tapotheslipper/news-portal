<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseTagController;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminTagController extends Controller {
    protected BaseTagController $common;

    public function __construct() {
        $this->common = new BaseTagController();
    }

    public function index(): View {
        $tags = $this->common->getAllTags(withCount: true);
        return view('pages.admin.tags.index', compact('tags'));
    }

    public function create(): View {
        return view('pages.admin.tags.form', ['tag' => new Tag()]);
    }

    public function store(Request $request): RedirectResponse {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $this->common->createTag($data);
        return redirect()->route('admin.tags.index')->with('status', 'Тег создан.');
    }

    public function edit(string $tag_slug): View {
        $tag = $this->common->getTagBySlug($tag_slug);
        return view('pages.admin.tags.form', compact('tag'));
    }

    public function update(Request $request, string $tag_slug): RedirectResponse {
        $tag = $this->common->getTagBySlug($tag_slug);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $this->common->updateTag($tag, $data);
        return redirect()->route('admin.tags.index')->with('status', 'Тег обновлён.');
    }

    public function destroy(string $tag_slug): RedirectResponse {
        $tag = $this->common->getTagBySlug($tag_slug);
        $this->common->deleteTag($tag);
        return redirect()->route('admin.tags.index')->with('status', 'Тег удалён.');
    }
}