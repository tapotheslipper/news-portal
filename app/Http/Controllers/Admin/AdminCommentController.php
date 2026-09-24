<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\BaseCommentController;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCommentController extends Controller {
    protected BaseCommentController $common;

    public function __construct()
    {
        $this->common = new BaseCommentController();
    }

    public function index(): View {
        $comments = $this->common->getPaginatedComments();
        return view('pages.admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment): RedirectResponse {
        $this->common->deleteComment($comment);
        return redirect()->route('admin.comments.index')->with('status', 'Комментарий удалён.');
    }
}