@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('articles.index') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}">
                                {{ $article->category->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 15) }}</li>
                    </ol>
                </nav>

                <article>
                    <h1 class="mb-2">{{ $article->title }}</h1>
                    <p class="text-muted">
                        Написано: {{ $article->created_at->format('d.m.Y H:i') }}
                        @if ($article->updated_at && $article->updated_at->timestamp !== $article->created_at->timestamp)
                             | Изменено: {{ $article->updated_at->format('d.m.Y H:i') }}
                        @endif
                    </p>

                    <div class="article-content fs-5 mt-4">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection