@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">Последние новости</h1>

                @forelse ($latestArticles as $article)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="card-title h5">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-muted small mb-1">
                                {{ $article->category->name }} . {{ $article->created_at->format('d.m.Y H:i') }}
                            </p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($article->content), 150) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Пока нет опубликованных новостей.</p>
                @endforelse

                <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">Все новости</a>
            </div>

            <div class="col-md-4">
                <h2 class="h5 mb-3">Категории</h2>
                <ul class="list-group">
                    @forelse ($popularCategories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('articles.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            <span class="badge bg-primary rounded-pill">{{ $category->articles_count }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Категорий пока нет.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection