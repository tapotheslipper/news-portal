@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Категория</h1>

        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('articles.index', ['category' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                            <span class="badge bg-secondary">{{ $category->articles_count }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Категорий пока нет.</p>
            @endforelse
        </div>
    </div>
@endsection