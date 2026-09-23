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
                            <p class="card-text">{{ Str::limit(strip_tags($article->content), 200) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">
                        На данный момент статей нет.
                    </p>
                @endforelse

                <div class="d-flex justify-content-center mt-4">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection