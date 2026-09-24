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
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Str::limit($article->title, 15) }}
                        </li>
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

                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="justify-content-center img-fluid" alt="{{ $article->title }}">
                    @endif

                    <div class="article-content fs-5 mt-4">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    @if ($article->tags->isNotEmpty())
                        <div class="mt-4">
                            @foreach ($article->tags->sortBy('name') as $tag)
                                <a href="{{ route('articles.index', ['tags' => $tag->slug]) }}" class="badge bg-secondary text-decoration-none">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </article>

                <hr class="my-4">

                <section>
                    <h2 class="h4 mb-3">Комментарии ({{ $article->comments->count() }})</h2>
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    @auth
                        <form method="POST" action="{{ route('comments.store', $article->slug) }}" class="mb-4">
                            @csrf
                            <div class="mb-2">
                                <textarea name="content" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Ваш комментарий...">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
                        </form>
                    @else
                        <p class="text-muted">
                            <a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.
                        </p>
                    @endauth

                    @forelse ($article->comments as $comment)
                        <div class="border-bottom pb-2 mb-2">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->author->name ?? 'Пользователь удалён' }}</strong>
                                <span class="text-muted-small">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <p class="mb-1">{{ $comment->content }}</p>
                            @auth
                                @if (Auth::id() === $comment->user_id || Auth::user()->isAdmin())
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" unsubmit="return confirm('Удалить комментарий?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0">Удалить</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <p class="text-muted">Комментариев пока нет.</p>
                    @endforelse
                </section>
            </div>
        </div>
    </div>
@endsection