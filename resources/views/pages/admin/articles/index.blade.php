@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Новости (Articles, Статьи)</h1>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Добавить новость</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Категория</th>
                    <th>Опубликовано</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>
                        @if ($article->is_published)
                        <span class="badge bg-success">Да</span>
                        @else
                        <span class="badge bg-secondary">Нет</span>
                        @endif
                    </td>
                    <td>{{ $article->created_at->format('d.m.Y H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.articles.edit', $article->slug) }}" class="btn btn-sm btn-outline-primary">Изменить</a>
                        <form action="{{ route('admin.articles.destroy', $article->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить новость {{ $article->title }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted">Новостей пока нет.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>
@endsection