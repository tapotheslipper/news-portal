@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">
            @if ($category_slug)
                Категория: {{ $articles->first()?->category->name ?? 'Архив' }}
            @else
                Последние публикации
            @endif
        </h1>

        <form method="GET" action="{{ route('articles.index') }}" class="row g-2 mb-4">
            @if ($category_slug)
                <input type="hidden" name="category" value="{{ $category_slug }}">
            @endif
            @if ($tag_slug)
                <input type="hidden" name="tag" value="{{ $tag_slug }}">
            @endif
            <div class="col-auto flex-grow-1">
                <input type="text" name="search" class="form-control" placeholder="Поиск по названию новости..." value="{{ $search }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Найти</button>
                @if ($search)
                    <a href="{{ route('articles.index', array_filter(['category' => $category_slug, 'tag' => $tag_slug])) }}" class="btn btn-outline-secondary">Сбросить</a>
                @endif
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                @forelse ($articles as $article)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-muted">
                                Категория: <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}">
                                    {{ $article->category->name }}
                                </a> |
                                Дата: {{ $article->created_at->format('d.m.Y H:i') }}
                            </p>
                            @if ($article->tags->isNotEmpty())
                                <p class="mb-2">
                                    @foreach ($article->tags->sortBy('name') as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" class="badge bg-secondary text-decoration-none">{{ $tag->name }}</a>
                                    @endforeach
                                </p>
                            @endif
                            <p class="card-text">{{ Str::limit(strip_tags($article->content), 200) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">
                        @if ($search)
                            По запросу '{{ $search }}' ничего не найдено.
                        @else
                            На данный момент статей нет.
                        @endif
                    </p>
                @endforelse

                <div class="d-flex justify-content-center mt-4">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection