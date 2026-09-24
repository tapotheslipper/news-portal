<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Base\BaseArticleController;
use App\Http\Controllers\Base\BaseCommentController;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PublicCommentController extends Controller {
    protected BaseCommentController $common;
    protected BaseArticleController $articles;

    public function __construct()
    {
        $this->middleware('auth');
        $this->common = new BaseCommentController();
        $this->articles = new BaseArticleController();
    }

    public function store(Request $request, string $article_slug): RedirectResponse {
        $article = $this->articles->getArticleBySlug($article_slug, onlyPublished: true);
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000']
        ]);
        $this->common->createComment($article, $request->user()->id, $data['content']);
        return redirect()->route('articles.show', $article->slug)->with('status', 'Комментарий добавлен.');
    }

    public function destroy(Request $request, Comment $comment): RedirectResponse {
        if ($comment->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            abort(403);
        }
        $article = $comment->article;
        $this->common->deleteComment($comment);
        return redirect()->route('articles.show', $article->slug)->with('status', 'Комметарий удалён.');
    }
}