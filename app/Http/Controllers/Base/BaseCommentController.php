<?php

namespace APp\Http\Controllers\Base;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseCommentController {
    public function getPaginatedComments(int $perPage = 25): LengthAwarePaginator {
        return Comment::with(['article', 'author'])->latest()->paginate($perPage);
    }

    public function createComment(Article $article, int $userId, string $content): Comment {
        return $article->comments()->create([
            'user_id' => $userId,
            'content' => $content
        ]);
    }

    public function deleteComment(Comment $comment): bool {
        return (bool) $comment->delete();
    }
}