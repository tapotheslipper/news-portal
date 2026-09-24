@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Комментарии (Comments)</h1>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Новость</th>
                    <th>Автор</th>
                    <th>Текст</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>
                            <a href="{{ route('articles.show', $comment->article->slug) }}">{{ $comment->article->title }}</a>
                        </td>
                        <td>{{ $comment->author->name ?? 'Пользователь удалён' }}</td>
                        <td>{{ Str::limit($comment->content, 80) }}</td>
                        <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-end">
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить комментарий?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Комментариев пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
    </div>
@endsection