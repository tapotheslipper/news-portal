@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="mb-0">{{ $article->title }}</h1>
                    <a href="{{ route('admin.articles.edit', $article->slug) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                </div>
                <p class="text-muted">
                    Категория: {{ $article->category->name }} .
                    {{ $article->is_published ? 'Опубликовано' : 'Черновик' }} .
                    {{ $article->created_at->format('d.m.Y H:i') }}
                </p>
                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid mb-3" alt="">
                @endif
                <div class="fs-5">{!! nl2br(e($article->content)) !!}</div>
            </div>
        </div>
    </div>
@endsection